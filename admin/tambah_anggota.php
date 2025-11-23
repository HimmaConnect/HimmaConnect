<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

$defaultPassword = md5("hima123"); // PASSWORD DEFAULT

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama'];
    $nim   = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

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
        "INSERT INTO anggota (nama, nim, prodi, email, password, foto) 
         VALUES ('$nama', '$nim', '$prodi', '$email', '$defaultPassword', '$fotoName')"
    );

    header("Location: anggota.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="bg-white shadow-sm border-b py-4 px-6 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-blue-700">Tambah Anggota Baru</h1>
</div>

<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-lg rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Tambah Anggota</h2>

        <!-- Tambahin enctype -->
        <form method="POST" enctype="multipart/form-data" class="space-y-5">

            <div>
                <label class="font-semibold">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">NIM</label>
                <input type="text" name="nim" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Program Studi</label>
                <input type="text" name="prodi" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- FOTO -->
            <div>
                <label class="font-semibold">Foto</label>
                <input type="file" name="foto"
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                <p class="text-sm text-gray-500 italic">Opsional, boleh kosong.</p>
            </div>

            <p class="text-sm text-gray-500 italic">
                Password otomatis: <span class="font-semibold">hima123</span>
            </p>

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
