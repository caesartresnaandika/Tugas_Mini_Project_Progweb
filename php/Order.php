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
                <li><a href="Detail.php">IU H.E.R. WORLD TOUR CONCERT 2024</a></li>
                <li><a href="Order.php">Order</a></li>
            </ul>
        </div>
        <section class = detailPemesanan>
            <img id ="gambarIU" src="../gambar/iu.png" alt="Konsernya IU">
            <div id = detail>
                <h3>IU H.E.R. WORLD TOUR CONCERT IN JAKARTA 2024</h3><br>
                <div id =paket>
                    <table>
                        <tr>
                            <td>CAT 1</td>
                        </tr>
                        <tr>
                            <td>2 Tiket</td>
                        </tr>
                    </table>
                </div>
                <div class="jamDanTanggal">
                    <table>
                        <tr>
                            <td id="tanggal">Tanggal</td>
                            <td id ="jam">Jam</td>
                        </tr>
                        <tr>
                            <td id="tanggal">27-28 April 2024</td>
                            <td id="jam">15:00 WIB</td>
                        </tr>
                    </table>
                </div>
                <div class="bagianTotal">
                    <p id="total">Total Pembayaran</p>
                    <p id="totalAngka">Rp 5.900.000</p>
                </div>
            </div>
        </section>
        
        <form action="post">
            <section class ="isiForm">
                <h2 class="judulTiapForm">Detail Pemesanan</h2>
                <p class="informasiForm">Isi formulir dengan benar karena e-tiket akan dikirim melalui e-mail sesuai detail pemesanan</p>
                <section class="infoPemesan">
                    <div>
                        <input type="text" id= "namaDepan" name="namaDepan" required placeholder="Nama Depan *">
                    </div>
                    <div>
                        <input type="text" id="namaBelakang" name ="namaBelakang" required placeholder ="Nama Belakang *">
                    </div>
                    <div>
                        <input type="email" id="email" name ="email" required placeholder ="Alamat e-mail *" pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-].[a-z]{2,}$">
                    </div>
                    <div>
                        <input type="number" id="nomorTelepon" name="nomorTelepon" required placeholder="No-Telepon *">
                    </div>
                </section>
                <h2 class="judulTiapForm">Detail Tiket</h2>
                <p class="informasiForm">Pastikan untuk mengisi detail dengan benar</p>
                <section class = "infoTiket">
                    <p class="jumlahTiket">Tiket 1</p>
                    <div class = tiket1>
                        <label for="dataPemesan">Jika tiket 1 sama dengan Pemesan</label>
                        <input type="checkbox"id=dataPemesan>
                    </div>
                    <div>
                        <input type="text" id= "namaDepan" name="namaDepan" required placeholder="Nama Depan *">
                    </div>
                    <div>
                        <input type="text" id="namaBelakang" name ="namaBelakang" required placeholder ="Nama Belakang *">
                    </div>
                    <div>
                        <input type="email" id="email" name ="email" required placeholder ="Alamat e-mail *"pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-].[a-z]{2,}$">
                    </div>
                    <div>
                        <input type="number" id="nomorTelepon" name="nomorTelepon" required placeholder="No-Telepon *">
                    </div>
                    <p class="jumlahTiket">Tiket 2</p>
                    <div>
                        <input type="text" id= "namaDepan" name="namaDepan" required placeholder="Nama Depan *">
                    </div>
                    <div>
                        <input type="text" id="namaBelakang" name ="namaBelakang" required placeholder ="Nama Belakang *">
                    </div>
                    <div>
                        <input type="email" id="email" name ="email" required placeholder ="Alamat e-mail *"pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-].[a-z]{2,}$">
                    </div>
                    <div>
                        <input type="number" id="nomorTelepon" name="nomorTelepon" required placeholder="No-Telepon *">
                    </div>
                </section>
                
            </section>
            <div>
                <input type="submit" id = "tombolPembayaran" value="Lanjutkan Pembayaran"></input>
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
                <a href=""><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <div class="footernav">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact Us</a></li>
                </ul>
            </div>
        </div>
     </footer>
    
</body>
</html>