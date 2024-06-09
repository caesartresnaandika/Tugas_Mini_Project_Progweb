<?php
// session_start.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: LoginSignUp.php");
    exit();
}
?>