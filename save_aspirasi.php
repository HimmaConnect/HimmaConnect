<?php
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $isi    = mysqli_real_escape_string($conn, $_POST['isi']);

    $query = "INSERT INTO aspirasi (nama, email, isi) VALUES ('$nama', '$email', '$isi')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Aspirasi berhasil dikirim!'); window.location='index.php#aspirasi';</script>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>
