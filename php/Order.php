<?php
// Ambil data dari form yang dikirimkan
$nama_konser = $_POST['nama_konser'] ?? '';
$quantity = $_POST['quantity'] ?? [];

// Ambil detail tiket dari database
include "../php/koneksi.php";
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
        <a href="Home.html" class="judul"><span>TiketQ</span></a>
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
        
        <form action="post">
            <section class="isiForm">
                <h2 class="judulTiapForm">Detail Pemesanan</h2>
                <p class="informasiForm">Isi formulir dengan benar karena e-tiket akan dikirim melalui e-mail sesuai detail pemesanan</p>
                <section class="infoPemesan">
                    <div>
                        <input type="text" id="namaDepan" name="namaDepan" required placeholder="Nama Depan *">
                    </div>
                    <div>
                        <input type="text" id="namaBelakang" name="namaBelakang" required placeholder="Nama Belakang *">
                    </div>
                    <div>
                        <input type="email" id="email" name="email" required placeholder="Alamat e-mail *" pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-].[a-z]{2,}$">
                    </div>
                    <div>
                        <input type="number" id="nomorTelepon" name="nomorTelepon" required placeholder="No-Telepon *">
                    </div>
                </section>
                <h2 class="judulTiapForm">Detail Tiket</h2>
                <p class="informasiForm">Pastikan untuk mengisi detail dengan benar</p>
                <section class="infoTiket">
                    <?php foreach ($tickets as $ticket): ?>
                        <?php for ($i = 0; $i < $ticket['qty']; $i++): ?>
                            <p class="jumlahTiket">Tiket <?php echo $i + 1; ?> (<?php echo htmlspecialchars($ticket['tipe_ticket']); ?>)</p>
                            <div class="tiket1">
                                <?php if ($i == 0): ?>
                                    <label for="dataPemesan_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>">Jika tiket sama dengan Pemesan</label>
                                    <input type="checkbox" id="dataPemesan_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>" name="dataPemesan[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" value="1">
                                <?php endif; ?>
                            </div>
                            <div>
                                <input type="text" id="namaDepan_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>" name="namaDepanTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Nama Depan *">
                            </div>
                            <div>
                                <input type="text" id="namaBelakang_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>" name="namaBelakangTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Nama Belakang *">
                            </div>
                            <div>
                                <input type="email" id="email_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>" name="emailTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="Alamat e-mail *" pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-].[a-z]{2,}$">
                            </div>
                            <div>
                                <input type="number" id="nomorTelepon_<?php echo $ticket['id_ticket']; ?>_<?php echo $i; ?>" name="nomorTeleponTiket[<?php echo $ticket['id_ticket']; ?>][<?php echo $i; ?>]" required placeholder="No-Telepon *">
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