<?php
include '../config/koneksi.php';

$id = $_POST['id'];
$balasan = $_POST['balasan'];

mysqli_query($conn, "UPDATE aspirasi SET balasan = '$balasan' WHERE id_aspirasi = $id");

header("Location: aspirasi.php");
exit;
?>
