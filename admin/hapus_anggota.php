<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// pastikan parameter sesuai dengan link
if (!isset($_GET['id_anggota'])) {
    die("ID tidak ada");
}

$id = $_GET['id_anggota'];

// jalankan query hapus
$query = mysqli_query($conn, "DELETE FROM anggota WHERE id_anggota='$id'");

if ($query) {
    header("Location: anggota.php?status=deleted");
exit;

} else {
    die("Gagal menghapus data: " . mysqli_error($conn));
}
?>
