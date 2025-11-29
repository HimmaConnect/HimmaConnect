<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {
        $folder = "../uploads/";
        $fileName = time() . "-" . $gambar;
        move_uploaded_file($tmp, $folder . $fileName);
        $gambar = $fileName;
    } else {
        $gambar = ""; // atau kosong, sesuai DB
    }

    mysqli_query($conn,
        "INSERT INTO kegiatan (judul, deskripsi, tanggal, gambar)
         VALUES ('$judul','$deskripsi','$tanggal','$gambar')"
    );

    header("Location: kegiatan.php?status=added");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan — Admin HimaConnect</title>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Header Fixed -->
<div class="bg-white shadow-sm border-b py-3 px-4 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-lg font-bold text-blue-700">Tambah Kegiatan</h1>
</div>

<!-- Konten Utama -->
<div class="pt-20 px-4 pb-8">

    <div class="bg-white p-5 shadow rounded-xl border">

        <h2 class="text-xl font-bold mb-5 text-gray-800">Tambah Kegiatan</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">

            <div>
                <label class="block font-semibold mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="5" required
                          class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                          placeholder="Jelaskan kegiatan secara singkat..."></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-1">Upload Gambar (Opsional)</label>
                <input type="file" name="gambar"
                       class="w-full p-3 border rounded-lg bg-white">
            </div>

            <div class="flex flex-col gap-3 pt-2">
                <button type="submit" name="simpan"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                    Simpan
                </button>

                <a href="kegiatan.php"
                   class="w-full text-center py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    ← Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>