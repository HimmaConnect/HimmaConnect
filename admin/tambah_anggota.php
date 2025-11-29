<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $divisi = $_POST['divisi'];
    $email  = $_POST['email'];
    $fotoName = "default.jpg";

    if (!empty($_FILES['foto']['name'])) {
        $fileTmp  = $_FILES['foto']['tmp_name'];
        $fileName = time() . "-" . $_FILES['foto']['name'];
        $dest = "../uploads/anggota/" . $fileName;
        move_uploaded_file($fileTmp, $dest);
        $fotoName = $fileName;
    }

    mysqli_query($conn, 
        "INSERT INTO anggota (nama, divisi, email, foto) 
         VALUES ('$nama', '$divisi', '$email', '$fotoName')"
    );

    header("Location: anggota.php?status=added");  
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota — Admin HimaConnect</title>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Header Fixed -->
<div class="bg-white shadow-sm border-b py-3 px-4 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-lg font-bold text-blue-700">Tambah Anggota</h1>
</div>

<!-- Konten Utama -->
<div class="pt-20 px-4 pb-8">

    <div class="bg-white p-5 shadow rounded-xl border">

        <h2 class="text-xl font-bold mb-5 text-gray-800">Tambah Anggota</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">

            <div>
                <label class="block font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-1">Divisi</label>
                <select name="divisi" required
                        class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="" disabled selected>Pilih Divisi</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Acara">Acara</option>
                    <option value="Dokumentasi">Dokumentasi</option>
                    <option value="Perlengkapan">Perlengkapan</option>
                    <option value="Konsumsi">Konsumsi</option>
                    <option value="Humas">Humas</option>
                    <option value="Media">Media</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="block font-semibold mb-1">Foto (Opsional)</label>
                <input type="file" name="foto"
                       class="w-full p-3 border rounded-lg bg-white">
                <p class="text-sm text-gray-500 mt-1">Boleh dikosongkan.</p>
            </div>

            <div class="flex flex-col gap-3 pt-3">
                <button type="submit" name="simpan"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                    Simpan
                </button>

                <a href="anggota.php"
                   class="w-full text-center py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>