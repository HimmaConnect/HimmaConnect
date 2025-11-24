<?php
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $isi    = $_POST['isi'];
    $tanggal = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO aspirasi (nama, email, isi, tanggal, balasan) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $isi, $tanggal, $balasan);

    $balasan = ""; // default kosong

    if ($stmt->execute()) {
        echo "<script>alert('Aspirasi berhasil dikirim!'); window.location='index.php#aspirasi';</script>";
    } else {
        echo "Gagal: " . $stmt->error;
    }
}
?>