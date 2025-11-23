<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// Ambil ID aspirasi
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM aspirasi WHERE id_aspirasi = $id");
$row  = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Aspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Aspirasi</h2>

    <div class="space-y-4 text-gray-700">

        <p><span class="font-semibold">Nama:</span> <?= htmlspecialchars($row['nama']) ?></p>
        <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($row['email']) ?></p>
        <p><span class="font-semibold">Tanggal:</span> <?= htmlspecialchars($row['tanggal']) ?></p>

        <p class="font-semibold">Isi Aspirasi:</p>
        <div class="p-4 bg-gray-100 rounded-lg border">
            <?= nl2br(htmlspecialchars($row['isi'])) ?>
        </div>

        <p class="font-semibold mt-4">Balasan Admin:</p>
        <form action="proses_balas.php" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?= $row['id_aspirasi'] ?>">

            <textarea name="balasan" rows="5"
                class="w-full p-3 border rounded-lg"><?= htmlspecialchars($row['balasan']) ?></textarea>

            <button class="px-5 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Kirim Balasan
            </button>
        </form>

    </div>

    <a href="aspirasi.php" class="inline-block mt-6 text-blue-600 hover:underline">
        ← Kembali
    </a>

</div>

</body>
</html>
