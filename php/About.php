<?php
  session_start();
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
  $isLoggedIn = !empty($username);
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>TicketQ</title>

    <!-- link css  -->
    <link href="https://fonts.cdnfonts.com/css/secular-one" rel="stylesheet">
    <link rel="stylesheet" href="../css/StyleAbout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    

    <!-- header section  starts-->
    <header>
        <a href="../php/Home2.php" class="judul"><span>TiketQ</span></a>
        <ul class="navlist">
            <li><a href="../php/Home2.php">Rumah</a></li>
            <li><a href="../php/ListKonser.php">List Konser</a></li>
            <li><a href="../php/About.php">Tentang</a></li>
            <li><a href="#foot">Kontak</a></li>
        </ul>
        <div class="gabung_kanan">
            <form method="GET" action="../php/Home2.php">
                <div class="searchBox">
                    <input type="text" class="searchText" name="searchText" placeholder="Masukkan konser/artis/lokasi ...">
                    <button type="submit" class="searchBtn" id="searchButton">
                        <i class="fas fa-search fa-3x"></i>
                    </button>
                </div>
            </form>
            <div class="icons">
                <a href="../php/Keranjang.php" class="apalah"><img src="../gambar/keranjang.png"></a>
            </div>
            <div class="masuk" id="user-menu">
                <a href="../php/LoginSignup.php"><p>Masuk</p></a>
            </div>
        </div>
    </header>
    <!-- header section ends -->

    <!-- login awal -->
    <script>
    const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    const username = <?php echo json_encode($username); ?>;

    document.addEventListener('DOMContentLoaded', () => {
        const userMenu = document.getElementById('user-menu');
        if (isLoggedIn) {
            userMenu.innerHTML = `
                <div class="dropdown">
                    <i class="fa-solid fa-user"><button class="dropdown-button">&nbsp;&nbsp;${username}</button></i>
                    <div class="dropdown-content">
                        <a href="logout.php">Log Out</a>
                    </div>
                </div>
            `;
        }
    });
</script>
    <section class="about">
    <div class="container">
        <h1>Tentang Kami</h1>
        <p>Kami dari kelompok 6 Grup C Praktikum Pemrograman web membuat web ini untuk memenuhi nilai tugas akhir dari mata kuliah Praktikum Pemrograman Web Semester Genap 2023/2024</p>
        <div class="members">
            <div class="member">
                <span class="member-id">Amelia Putri Aftiana</span>
                <span class="member-name">71220867</span>
            </div>
            <div class="member">
                <span class="member-id">Caesar Tresna Andika</span>
                <span class="member-name">71220834</span>
            </div>
            <div class="member">
                <span class="member-id">Jonathan Wijaya</span>
                <span class="member-name">71220880</span>
            </div>
        </div>
    </div>
    </section>
    
    

</body>
<footer>
    <div class="footerContainer" id="foot"></div>
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
            <li><a href="#foot">Contact Us</a></li>
        </ul>
    </div>
</footer>
</html>