<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM aspirasi WHERE id_aspirasi='$id'");

        header("Location: aspirasi.php?status=deleted");
exit;
?>