<?php
include "../php/koneksi.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to access this page.');
    window.location.href='LoginSignUp.php';
    </script>";
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (!$cart) {
    echo "<script>alert('Your cart is empty.');
    window.location.href='Home2.php';
    </script>";
    exit();
}

$tickets = [];
foreach ($cart as $id_ticket => $quantity) {
    $sql = "SELECT * FROM ticket WHERE id_ticket = $id_ticket";
    if ($result = $conn->query($sql)) {
        if ($ticket = $result->fetch_assoc()) {
            $ticket['quantity'] = $quantity;
            $tickets[] = $ticket;
        }
    } else {
        echo "Error fetching tickets: " . $conn->error;
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
                <a href="#" class="icons"><img src="../gambar/keranjang.png"></a>
            </td>
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
            <table class="stock">
                <tr>
                    <th>Tipe Ticket</th>
                    <th>Harga</th>
                    <th>Jumlah Ticket</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($tickets): ?>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ticket['tipe_ticket']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['harga']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($ticket['harga'] * $ticket['quantity']); ?></td>
                        <td>
                            <a href="RemoveFromCart.php?id_ticket=<?php echo htmlspecialchars($ticket['id_ticket']); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Keranjang kosong</td></tr>
                <?php endif; ?>
            </table>
            <button type="submit" class="buy-tickets-btn">Checkout</button>
        </form>
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
