<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to access this page.');
    window.location.href='LoginSignUp.php';
    </script>";
    exit();
}
include "../php/koneksi.php";
// Ambil data dari form yang dikirimkan
$nama_konser = $_POST['nama_konser'] ?? '';
$quantity = $_POST['quantity'] ?? [];


// Ambil detail tiket dari database
$tickets = [];

foreach ($quantity as $id_ticket => $qty) {
    if ($qty > 0) {
        $sql = "SELECT * FROM ticket WHERE id_ticket = $id_ticket";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['qty'] = $qty;
                $tickets[] = $row;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/StyleOrder.css">
    <link href="https://fonts.cdnfonts.com/css/secular-one" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>TicketQ</title>
</head>
<body>
    <header>
        <a href="Home2.php" class="judul"><span>TiketQ</span></a>
        <table>
            <td>
                <a href="#" class="icons"><img src="../gambar/keranjang.png"></a>
            </td>
            <td>
                <a href="#" class="masuk"><span>Masuk</span></a>
            </td>
        </table>
    </header>
    <main>
        <div>
            <ul class="breadcrumb">
                <li><a href="Home2.php">Home</a></li>
                <li><a href="Detail.php"><?php echo htmlspecialchars($nama_konser); ?></a></li>
                <li><a href="Order.php">Order</a></li>
            </ul>
        </div>
        <section class="detailPemesanan">
            <img id="gambarIU" src="../gambar/iu.png" alt="Konsernya IU">
            <div id="detail">
                <h3><?php echo htmlspecialchars($nama_konser); ?></h3><br>
                <div id="paket">
                    <table>
                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ticket['tipe_ticket']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['qty']); ?> Tiket</td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="bagianTotal">
                    <p id="total">Total Pembayaran</p>
                    <p id="totalAngka">
                        <?php
                        $total = 0;
                        foreach ($tickets as $ticket) {
                            $total += $ticket['harga'] * $ticket['qty'];
                        }
                        echo 'Rp ' . number_format($total, 0, ',', '.');
                        ?>
                    </p>
                </div>
            </div>
        </section>
        
        <form method="POST" action="Order.php">
                <h2 class="judulTiapForm">Detail Tiket</h2>
                <p class="informasiForm">Pastikan untuk mengisi detail dengan benar</p>
                <section class="infoTiket">
                    <?php foreach ($tickets as $ticket): ?>  
                        <?php for ($i = 0; $i < $ticket['qty']; $i++): ?>
                            <p class="jumlahTiket">Tiket <?php echo $i + 1; ?> (<?php echo htmlspecialchars($ticket['tipe_ticket']); ?>)</p>
                            <div class="tiket1">
                                <?php if ($i == 0): ?>
                                    <label for="dataPemesan<?php echo $ticket['id_ticket']; ?><?php echo $i; ?>">Jika tiket sama dengan Pemesan</label>
                                    <input type="checkbox" id="dataPemesan<?php echo $ticket['id_ticket']; ?><?php echo $i; ?>" name="dataPemesan[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" value="1">
                                <?php endif; ?>
                            </div>
                            <div>
                                <input type="text" id="namaLengkap[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" name="namaDepanTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Nama Depan *">
                            </div>
                            <div>
                                <input type="text" id="namaBelakang[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" name="namaBelakangTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Nama Belakang *">
                            </div>
                            <div>
                                <input type="email" id="email[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" name="emailTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Alamat e-mail *" >
                            </div>
                            <div>
                                <input type="number" id="nomorTelepon[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" name="nomorTeleponTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="No-Telepon *">
                            </div>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                </section>
            </section>
            <div>
                <input type="submit" id="tombolPembayaran" value="Lanjutkan Pembayaran"></input>
                
            </div>
        </form>
    </main>
    <footer>
        <div class="footerContainer"></div>
            <div class="judul_lagi">
                <!-- <h1>TiketQ</h1> -->
            </div>
            <div class="socialIcons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO keranjang (id_user,nama_konser, tipe_ticket, qty, harga, nama_depan, nama_belakang, email, nomor_telepon) VALUES (?,?,?, ?,?, ?, ?, ?, ?)");
    // Insert data ke dalam tabel keranjang
    foreach ($tickets as $ticket) {
        // Sesuaikan dengan ID pengguna yang sebenarnya
        $nama_konser = $_POST['nama_konser'] ?? '';
        $tipe_ticket = $ticket['tipe_ticket'];
        $harga = $ticket['harga'];
        $id_user =$_SESSION['user_id'];
        

        for ($i = 0; $i < $ticket['qty']; $i++) {
            $nama_depan_tiket = ['namaDepanTiket'][$ticket['id_ticket']][$i] ?? '';
            $nama_belakang_tiket = ['namaBelakangTiket'][$ticket['id_ticket']][$i] ?? '';
            $email_tiket = ['emailTiket'][$ticket['id_ticket']][$i] ?? '';
            $nomor_telepon_tiket = ['nomorTeleponTiket'][$ticket['id_ticket']][$i] ?? '';
            $qty = 1;

            $stmt->bind_param("issidssss", $id_user,$nama_konser, $tipe_ticket, $qty, $harga, $nama_depan_tiket, $nama_belakang_tiket, $email_tiket, $nomor_telepon_tiket);

    // Ambil data dari form
    $namaDepan = $_POST['namaDepan'] ?? '';
    $namaBelakang = $_POST['namaBelakang'] ?? '';
    $email = $_POST['email'] ?? '';
    $nomorTelepon = $_POST['nomorTelepon'] ?? '';

    // // Ambil detail tiket dari form
    $namaDepanTiket = $_POST['namaDepanTiket'] ?? [];
    $namaBelakangTiket = $_POST['namaBelakangTiket'] ?? [];
    $emailTiket = $_POST['emailTiket'] ?? [];
    $nomorTeleponTiket = $_POST['nomorTeleponTiket'] ?? [];

    // Insert data ke dalam tabel keranjang
    $stmt = $conn->prepare("INSERT INTO keranjang (id_user, nama_konser, tipe_ticket, qty, harga, nama_depan, nama_belakang, email, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisssi", $id_user, $nama_konser, $tipe_ticket, $qty, $harga, $namaDepan, $namaBelakang, $email, $nomorTelepon);

    foreach ($tickets as $ticket){
        for ($i = 0; $i < $ticket['qty']; $i++) {
            $id_user = 1; // Sesuaikan dengan ID pengguna yang sebenarnya
            $nama_konser = $nama_konser;
            $tipe_ticket = $ticket['tipe_ticket'];
            $qty = 1;
            $harga = $ticket['harga'];

            $namaDepan = $_POST['namaDepan'] ?? '';
            $namaBelakang = $_POST['namaBelakang'] ?? '';
            $email = $_POST['email'] ?? '';
            $nomorTelepon = $_POST['nomorTelepon'] ?? '';

            // if (isset($_POST['dataPemesan'][$ticket['id_ticket']][$i])) {
            //     $nama_depan_tiket = $namaDepan;
            //     $nama_belakang_tiket = $namaBelakang;
            //     $email_tiket = $email;
            //     $nomor_telepon_tiket = $nomorTelepon;
            // } else {
            //     $nama_depan_tiket = $namaDepanTiket[$ticket['id_ticket']][$i] ?? '';
            //     $nama_belakang_tiket = $namaBelakangTiket[$ticket['id_ticket']][$i] ?? '';
            //     $email_tiket = $emailTiket[$ticket['id_ticket']][$i] ?? '';
            //     $nomor_telepon_tiket = $nomorTeleponTiket[$ticket['id_ticket']][$i] ?? '';
            // }
            $stmt->execute();
        }
    }
    $stmt->close();
}
    }
}
exit; // Keluar dari skrip PHP
?>