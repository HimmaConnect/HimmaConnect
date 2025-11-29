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

    // ---- UPLOAD FOTO ----
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
    <title>Tambah Anggota - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
</head>

<body class="bg-gray-100">

<div class="bg-white shadow-sm border-b py-4 px-6 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-blue-700">Tambah Anggota Baru</h1>
</div>

<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-lg rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Tambah Anggota</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-5">

            <div>
                <label class="font-semibold">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Divisi</label>
                <select name="divisi" required
                        class="w-full p-3 border rounded-xl bg-white focus:ring-2 focus:ring-blue-500 outline-none">

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
                <label class="font-semibold">Email</label>
                <input type="email" name="email" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Foto</label>
                <input type="file" name="foto"
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                <p class="text-sm text-gray-500 italic">Opsional, boleh kosong.</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" name="simpan"
                        class="px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow">
                    Simpan
                </button>

                <a href="anggota.php"
                   class="px-5 py-3 bg-gray-400 text-white rounded-xl hover:bg-gray-500 shadow">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>
