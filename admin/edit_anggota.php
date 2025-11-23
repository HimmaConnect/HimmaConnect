<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$id = $_GET['id_anggota'];

// Ambil data anggota lama
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$id'")
);

$foto_lama = $data['foto'];

// Update data
if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $nim    = $_POST['nim'];
    $prodi  = $_POST['prodi'];
    $email  = $_POST['email'];

    // Cek apakah ada upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $file_name = time() . "_" . $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        // Simpan foto baru
        move_uploaded_file($tmp, "../uploads/anggota/" . $file_name);

        // Hapus foto lama jika ada
        if ($foto_lama && file_exists("../uploads/anggota/" . $foto_lama)) {
            unlink("../uploads/anggota/" . $foto_lama);
        }

        $foto_final = $file_name;
    } else {
        $foto_final = $foto_lama; // Kalau tidak upload foto baru
    }

    // Update database
    $query = "UPDATE anggota SET 
                nama='$nama',
                nim='$nim',
                prodi='$prodi',
                email='$email',
                foto='$foto_final'
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
    <h1 class="text-xl font-bold text-blue-700">Edit Data Anggota</h1>
</div>

<!-- CONTENT -->
<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-xl rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Form Edit Anggota</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-6">

            <!-- FOTO PREVIEW -->
            <div class="flex flex-col items-center">
                <img src="../uploads/anggota/<?= $foto_lama ?>" 
                     onerror="this.src='../uploads/anggota/default.jpg'"
                     class="w-32 h-32 rounded-full object-cover shadow mb-3">

                <label class="font-semibold">Ganti Foto (Opsional)</label>
                <input type="file" name="foto"
                       class="w-full p-2 border rounded-xl bg-gray-50">
            </div>

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
