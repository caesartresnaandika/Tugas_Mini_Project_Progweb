<?php
include "../php/koneksi.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to access this page.');
    window.location.href='LoginSignUp.php';
    </script>";
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_artis = isset($_GET['id_artis']) ? (int)$_GET['id_artis'] : 0;

$concert = null;
$sql = "SELECT * FROM konser WHERE id_artis = $id_artis";
if ($result = $conn->query($sql)) {
    $concert = $result->fetch_assoc();
} else {
    echo "Error fetching concert details: " . $conn->error;
}

$tickets = null;
$sql = "SELECT * FROM ticket WHERE id_artis = $id_artis";
if ($tickets = $conn->query($sql)) {
} else {
    echo "Error fetching tickets: " . $conn->error;
}

$detail_concerts = [];
$sql = "SELECT * FROM detail_konser WHERE id_artis = $id_artis";
if ($detail_result = $conn->query($sql)) {
    while ($row = $detail_result->fetch_assoc()) {
        $detail_concerts[] = $row;
    }
} else {
    echo "Error fetching detailed concert information: " . $conn->error;
}
?>

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.cdnfonts.com/css/secular-one" rel="stylesheet">
    <link rel="stylesheet" href="../css/StyleDetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>TicketQ</title>
</head>
<body>
<header>
    <a href="../php/Home2.php" class="judul"><span>TiketQ</span></a>
    <table>
        <tr>
            <td>
                <a href="#" class="icons"><img src="../gambar/keranjang.png"></a>
            </td>
            <td>
                <a href="#" class="masuk"><span>Masuk</span></a>
            </td>
        </tr>
    </table>
</header>
<main>
    <div>
        <ul class="breadcrumb">
            <li><a href="../php/Home2.php">Home</a></li>
            <li><a href="Detail.php?id_artis=<?php echo $id_artis; ?>"><?php echo htmlspecialchars($concert['nama_konser'] ?? ''); ?></a></li>
        </ul>
    </div>
    <center>
        <table>
            <tr>
                <td>
                    <div class="gambar_konser">
                        <?php if ($concert && isset($concert['image'])): ?>
                            <img id="gambar" src="data:image/jpeg;base64,<?php echo base64_encode($concert['image']); ?>" alt="Poster Konser">
                        <?php else: ?>
                            <p>Poster Konser tidak tersedia</p>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <div class="detail">
                        <p class="judul_konser"><?php echo htmlspecialchars($concert['nama_konser'] ?? ''); ?></p>
                        <ul class="detail_konser">
                            <li class="performer">Performer: <?php echo htmlspecialchars($concert['judul'] ?? ''); ?></li>
                            <li class="jam">Jam : <?php echo htmlspecialchars($detail_concerts[0]['time'] ?? ''); ?></li>
                            <li class="tanggal">Tanggal : <?php echo htmlspecialchars($detail_concerts[0]['detail_date'] ?? ''); ?></li>
                            <li class="lokasi">Lokasi : <?php echo htmlspecialchars($detail_concerts[0]['venue'] ?? ''); ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
        <div class="deskripsi_konser">
            <h1>Tentang Konser</h1>
            <p><?php echo htmlspecialchars($concert['tentang_konser'] ?? ''); ?></p>
        </div>
        <div class="seating_plan">
            <h1>Pengaturan tempat duduk</h1>
            <?php if ($concert && isset($concert['image_seat'])): ?>
                <img id="gambar_seat" src="data:image/jpeg;base64,<?php echo base64_encode($concert['image_seat']); ?>" alt="Seating Plan">
            <?php else: ?>
                <p>Seating Plan tidak tersedia</p>
            <?php endif; ?>
        </div>
        <div class="deskripsi_konser">
            <h1>Jadwal Konser</h1>
            <table class="stock">
                <tr>
                    <th>City</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Venue</th>
                </tr>
                <?php foreach ($detail_concerts as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['city']); ?></td>
                        <td><?php echo htmlspecialchars($detail['detail_date']); ?></td>
                        <td><?php echo htmlspecialchars($detail['time']); ?></td>
                        <td><?php echo htmlspecialchars($detail['venue']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="judul_ticket">
            <h1>Daftar Ticket</h1>
        </div>
        <form id="ticketForm" onsubmit="return validateTickets()" method="post" action="Order.php">
            <table class="stock">
                <tr>
                    <th>Tipe Ticket</th>
                    <th>Stock yang tersedia</th>
                    <th>Harga</th>
                    <th>Jumlah Ticket</th>
                </tr>
                <?php if ($tickets): ?>
                    <?php while($ticket = $tickets->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ticket['tipe_ticket']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['stock']); ?></td>
                        <td><?php echo number_format($ticket['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <input type="number" name="quantity[<?php echo htmlspecialchars($ticket['id_ticket']); ?>]" min="0" max="<?php echo htmlspecialchars($ticket['stock']); ?>" value="0">
                        </td>
                    </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr><td colspan="4">No tickets available</td></tr>
                <?php endif; ?>
            </table>
            <input type="hidden" name="nama_konser" value="<?php echo htmlspecialchars($concert['nama_konser']); ?>">
            <button type="submit" class="buy-tickets-btn">Buy Tickets Now!</button>
        </form>
        <div class="syarat">
            <h1>SYARAT & KETENTUAN</h1>
            <ol>
                <li>Tiket hanya dapat dibeli melalui website resmi. Tiket hanya dapat digunakan untuk masuk ke acara konser yang sesuai dengan jadwal dan lokasi yang tertera pada tiket.</li>
                <li>Nama sesuai dengan kartu identitas yang sah bersifat wajib untuk membeli Tiket ke konser</li>
                <li>Harga Tiket tidak termasuk Pajak Pemerintah yang berlaku dan Biaya Layanan lainnya.</li>
                <li>Setelah Anda berhasil melakukan pembelian tiket, E-Ticket akan dikirimkan ke email Anda. H-7 sebelum konser dimulai, nomor kursi akan muncul di E-Ticket yang telah Anda dapatkan sebelumnya. Anda perlu me-refresh link E-Ticket sebelumnya. Nomor kursi akan di-generate oleh sistem.</li>
                <li>Pengunjung wajib mematuhi segala peraturan yang ditetapkan oleh penyelenggara konser termasuk protokol kesehatan yang berlaku.</li>
                <li>Tiket yang sudah dibeli tidak dapat dikembalikan atau ditukarkan dengan alasan apapun kecuali acara dibatalkan oleh penyelenggara.</li>
            </ol>
        </div>
    </center>
</main>
<footer>
    <a href="#" class="judul_lagi"><span>TiketQ</span></a>
    <div class="socialIcons">
        <a href=""><i class="fa-brands fa-facebook"></i></a>
        <a href=""><i class="fa-brands fa-instagram"></i></a>
        <a href=""><i class="fa-brands fa-twitter"></i></a>
        <a href=""><i class="fa-brands fa-linkedin"></i></a>
    </div>
    <div class="footernav">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Contact Us</a></li>
        </ul>
    </div>
</footer>
<?php
$conn->close();
?>
<script>
    function validateTickets() {
        var quantities = document.querySelectorAll('input[name^="quantity"]');
        var total = 0;
        for (var i = 0; i < quantities.length; i++) {
            total += parseInt(quantities[i].value) || 0;
        }
        if (total == 0) {
            alert('Please select at least one ticket.');
            return false;
        }
        if (total > 6) {
            alert('You can only order up to 6 tickets per transaction.');
            return false;
        }
        return true;
    }
</script>
</body>
</html>