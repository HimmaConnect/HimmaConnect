<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: cek_aspirasi.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM aspirasi WHERE id_aspirasi = '$id'");
$asp = mysqli_fetch_assoc($data);

if (!$asp) {
    echo "Data tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Aspirasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-2xl p-6">

        <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail Aspirasi</h2>

        <div class="space-y-3">
            <div>
                <p class="text-gray-600 text-sm">Nama</p>
                <p class="text-lg font-semibold"><?= htmlspecialchars($asp['nama']) ?></p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-lg font-semibold"><?= htmlspecialchars($asp['email']) ?></p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Isi Aspirasi</p>
                <p class="text-lg bg-gray-50 p-3 rounded-lg border"><?= nl2br(htmlspecialchars($asp['isi'])) ?></p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Tanggal</p>
                <p class="text-lg font-semibold"><?= $asp['tanggal'] ?></p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Balasan Admin</p>
                
                <?php if ($asp['balasan'] == "" || $asp['balasan'] == null) { ?>
                    <p class="text-yellow-600 italic mt-1">Belum ada balasan</p>
                <?php } else { ?>
                    <p class="text-lg bg-green-50 p-3 rounded-lg border border-green-300 text-green-800">
                        <?= nl2br(htmlspecialchars($asp['balasan'])) ?>
                    </p>
                <?php } ?>
            </div>
        </div>

        <a href="cek_aspirasi.php" 
           class="inline-block mt-6 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
           Kembali
        </a>

    </div>
</div>

</body>
</html>
