
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="../css/NewLoginSignUp.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main"> 
        <div class="login">
            <form action="LoginSignUp.php" method="POST">
                <label id="loginLabel">Masuk</label>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="tombolLogin">Masuk</button>
            </form>
        </div>
        <div class="signup">
            <form action="LoginSignUp.php" method="POST">
                <label id="signupLabel">Daftar</label>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="number" name="noTelepon" placeholder="Phone Number" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <button type="submit" name="tombolSignUp">Daftar</button>
            </form>
        </div>
    </div>
    <script src="../js/LoginSignUp.js"></script>
</body>
<?php
include "koneksi.php";
session_start(); // Memulai sesi di awal

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tombolLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query untuk mencari data user berdasarkan username
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Username ditemukan, cek password
            $user = mysqli_fetch_assoc($result);
            if ($password === $user['password']) {
                // Password benar, proses login
                $_SESSION['username'] = $username;
                // Redirect ke halaman utama atau halaman setelah login
                echo "<script>alert('Login berhasil.');
                    window.location.href='Home2.php';
                    </script>";
                exit(); // Penting untuk menghentikan eksekusi PHP setelah redirect
            } else {
                // Password salah
                echo "<script>alert('Password salah.');</script>";
            }
        } else {
            // Username tidak ditemukan
            echo "<script>alert('Username tidak ditemukan.');</script>";
        }
    } elseif (isset($_POST['tombolSignUp'])) {
        // Ambil data dari formulir sign-up
        $username = $_POST['username'];
        $phone = $_POST['noTelepon'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Query untuk memeriksa apakah username sudah ada dalam database
        $checkUsernameQuery = "SELECT * FROM user WHERE username = '$username'";
        $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

        if (mysqli_num_rows($checkUsernameResult) > 0) {
            // Jika username sudah ada dalam database
            echo "<script>alert('Username sudah digunakan. Silakan gunakan username lain.');</script>";
        } else {
            // Jika username belum ada dalam database
            // validasi password dan konfirmasi password cocok
            if ($password === $confirmPassword) {
                // Jika password dan konfirmasi password cocok
                // //proses penyimpanan data ke dalam database
                $insertQuery = "INSERT INTO user (username, no_telepon, password) VALUES ('$username', '$phone', '$confirmPassword')";
                if (mysqli_query($conn, $insertQuery)) {
                    // Jika data berhasil disimpan ke dalam database
                    echo "<script>alert('Sign-up berhasil. Anda dapat melakukan login sekarang.');
                    window.location.href='Home2.php';
                    </script>";
                    exit();
                } else {
                    // Jika terjadi kesalahan saat menyimpan data ke dalam database
                    echo "<script>alert('Gagal menyimpan data, silahkan coba lagi.');</script>";
                }
            } else {
                // Jika password dan konfirmasi password tidak cocok
                echo "<script>alert('Password dan konfirmasi password tidak cocok.');</script>";
            }
        }
    }
}
?>
</html>