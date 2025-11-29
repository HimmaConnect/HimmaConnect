<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kegiatan WHERE id_kegiatan='$id'");

header("Location: kegiatan.php?status=deleted");
exit;
?>
