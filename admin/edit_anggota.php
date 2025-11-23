<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

// Fix parameter GET
$id = $_GET['id_anggota'];

// Ambil data anggota
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$id'")
);

// Update data
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    $query = "UPDATE anggota 
              SET nama='$nama', nim='$nim', prodi='$prodi', email='$email' 
              WHERE id_anggota='$id'";
    mysqli_query($conn, $query);

    header("Location: anggota.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-white shadow-sm border-b py-4 px-6 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-blue-700">Edit Anggota</h1>
</div>

<!-- CONTENT -->
<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-lg rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800"> Edit Data Anggota</h2>

        <form method="POST" class="space-y-5">

            <div>
                <label class="font-semibold">Nama Lengkap</label>
                <input type="text" name="nama"
                       value="<?= $data['nama']; ?>"
                       required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">NIM</label>
                <input type="text" name="nim"
                       value="<?= $data['nim']; ?>"
                       required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Program Studi</label>
                <input type="text" name="prodi"
                       value="<?= $data['prodi']; ?>"
                       required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email"
                       value="<?= $data['email']; ?>"
                       required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" name="update" 
                        class="px-5 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 shadow">
                    Update
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
