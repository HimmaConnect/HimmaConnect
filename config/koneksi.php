<?php
$host = "localhost";
$user = "root";       // username default XAMPP
$pass = "";           // password default kosong
$db   = "himaconnect_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// echo "Koneksi berhasil"; // aktifkan ini buat testing
?>
