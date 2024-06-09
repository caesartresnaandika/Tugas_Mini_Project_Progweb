<?php
include "../php/koneksi.php";
session_start();

$id_user = $_SESSION['user_id'];

// Mengambil data dari tabel keranjang berdasarkan id_user
$sql = "SELECT * FROM keranjang WHERE id_user = $id_user";
$result = $conn->query($sql);

$tickets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.cdnfonts.com/css/secular-one" rel="stylesheet">
    <link rel="stylesheet" href="../css/keranjang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cart - TicketQ</title>
</head>
<body>
<header>
    <a href="../php/Home2.php" class="judul"><span>TiketQ</span></a>
    <table>
        <tr>
            <td>
                <a href="#" class="masuk"><span>Masuk</span></a>
            </td>
        </tr>
    </table>
</header>
<main>
    <center>
        <div class="judul_ticket">
            <h1>Keranjang Anda</h1>
        </div>
        <form method="post" action="Checkout.php">
            <table class="stock cart-table">
                <tr>
                    <th>Nama Konser</th>
                    <th>Tipe Ticket</th>
                    <th>Harga</th>
                    <th>Jumlah Ticket</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($tickets): ?>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ticket['nama_konser']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['tipe_ticket']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['harga']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['qty']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['harga'] * $ticket['qty']); ?></td>
                        <td>
                            <a href="RemoveFromCart.php?id_keranjang=<?php echo htmlspecialchars($ticket['id_keranjang']); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">Keranjang kosong</td></tr>
                <?php endif; ?>
            </table>
        </form>
        <button type="button" class="tickets-btn" onclick="window.location.href='Home2.php'">Back</button>
    </center>
</main>
<footer>
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
</body>
</html>
