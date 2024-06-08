<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>TicketQ</title>

    <!-- link css  -->
    <link href="https://fonts.cdnfonts.com/css/secular-one" rel="stylesheet">
    <link rel="stylesheet" href="../css/StyleHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header section  starts-->
    <header>
        <a href="#" class="judul"><span>TiketQ</span></a>
        <ul class="navlist">
            <li><a href="Home2.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <div class="gabung_kanan">
            <form method="GET" action="Home2.php">
                <div class="searchBox">
                    <input type="text" class="searchText" name="searchText" placeholder="Masukkan konser/artis/lokasi ...">
                    <button type="submit" class="searchBtn" id="searchButton">
                        <i class="fas fa-search fa-3x"></i>
                    </button>
                </div>
            </form>
            <div class="icons">
                <a href="Keranjang.php" class="apalah"><img src="../gambar/keranjang.png"></a>
            </div>
            <div class="masuk">
                <p>Masuk</p>
            </div>
        </div>
    </header>
    <!-- header section ends  -->

    <!-- paling atas pokoknya mulai  -->
    <section class="home" id="home">
        <div class="content">
            <h3>Hot Deals</h3>
            <span>Penawaran terbaik kami</span>
            <p>Jangan sampai kehabisan!</p>
            <a href="Order.php" class="buttonhome">Beli Sekarang</a>
        </div>
    </section>

    <!-- recommendation section starts -->
    <section class="rekomen" id="rekomen">
           <div class="box-container">
            <?php
            include 'koneksi.php';

            $searchQuery = '';
            if (isset($_GET['searchText'])) {
                $searchQuery = $_GET['searchText'];
                $sql = "SELECT id_artis, nama_konser, lokasi, date, harga_mulai, image FROM konser 
                        WHERE nama_konser LIKE '%$searchQuery%' 
                        OR lokasi LIKE '%$searchQuery%' 
                        OR date LIKE '%$searchQuery%'";
            } else {
                $sql = "SELECT id_artis, nama_konser, lokasi, date, harga_mulai, image FROM konser";
            }

            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imageData = base64_encode($row['image']);
                        echo '<div class="box">';
                        echo '    <a href="Detail.php?id_artis=' . $row['id_artis'] . '">';
                        echo '        <div class="image">';
                        echo '            <img src="data:image/jpeg;base64,' . $imageData . '" alt="">';
                        echo '            <div class="icons">';
                        echo '                <a href="Detail.php?id_artis=' . $row['id_artis'] . '" class="detail product"></a>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </a>';
                        echo '    <a href="Detail.php?id_artis=' . $row['id_artis'] . '">';
                        echo '        <div class="content">';
                        echo '            <div class="lokasi"><img src="../gambar/location.png" width="18px"> ' . $row['lokasi'] . '</div>';
                        echo '            <div class="tanggal"><img src="../gambar/date.png" width="16px"> ' . $row['date'] . '</div>';
                        echo '            <div class="nama_konser"><h3>' . $row['nama_konser'] . '</h3></div>';
                        echo '            <h4>Mulai dari</h4>';
                        echo '            <div class="harga">' . $row['harga_mulai'] . '</div>';
                        echo '            <div class="ketersediaan">Tersedia</div>';
                        echo '        </div>';
                        echo '    </a>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
            }
            $conn->close();
            ?>
        </div>
    </section>
    <!-- recommendation section ends -->

</body>
<footer>
    <div class="footerContainer"></div>
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
</html>