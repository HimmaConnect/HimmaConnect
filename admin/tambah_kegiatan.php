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

    // Upload gambar
    if ($gambar != "") {
        $folder = "../uploads/";
        move_uploaded_file($tmp, $folder . $gambar);
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
    <title>Tambah Kegiatan - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-white shadow-sm border-b py-4 px-6 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-blue-700">Tambah Kegiatan Baru</h1>
</div>

<!-- CONTENT -->
<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-lg rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Tambah Kegiatan</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-5">

            <div>
                <label class="font-semibold">Judul Kegiatan</label>
                <input type="text" name="judul" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="5" required
                          class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>

            <div>
                <label class="font-semibold">Tanggal</label>
                <input type="date" name="tanggal" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Upload Gambar</label>
                <input type="file" name="gambar"
                       class="w-full p-3 border rounded-xl bg-white">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" name="simpan"
                        class="px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow">
                    Simpan
                </button>

                <a href="kegiatan.php"
                   class="px-5 py-3 bg-gray-400 text-white rounded-xl hover:bg-gray-500 shadow">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>
