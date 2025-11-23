<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// Ambil data berdasarkan id
$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_kegiatan='$id'")
);

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        $folder = "../uploads/";
        move_uploaded_file($tmp, $folder . $gambar);

        $query = "UPDATE kegiatan 
                  SET judul='$judul', deskripsi='$deskripsi', tanggal='$tanggal', gambar='$gambar' 
                  WHERE id_kegiatan='$id'";
    } else {
        $query = "UPDATE kegiatan 
                  SET judul='$judul', deskripsi='$deskripsi', tanggal='$tanggal' 
                  WHERE id_kegiatan='$id'";
    }

    mysqli_query($conn, $query);
    header("Location: kegiatan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kegiatan - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- HEADER -->
<div class="bg-white shadow-sm border-b py-4 px-6 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-xl font-bold text-blue-700">Edit Kegiatan</h1>
</div>

<!-- CONTENT -->
<div class="pt-24 px-6 pb-10 max-w-xl mx-auto">

    <div class="bg-white p-6 shadow-lg rounded-2xl border">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Kegiatan</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-5">

            <div>
                <label class="font-semibold">Judul Kegiatan</label>
                <input type="text" name="judul" value="<?= $data['judul'] ?>" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="5" required
                          class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"><?= $data['deskripsi'] ?></textarea>
            </div>

            <div>
                <label class="font-semibold">Tanggal</label>
                <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required
                       class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div>
                <label class="font-semibold">Gambar Saat Ini</label><br>
                <img src="../uploads/<?= $data['gambar'] ?>" 
                     class="w-32 h-32 object-cover rounded-lg border mb-3">
                
                <input type="file" name="gambar"
                       class="w-full p-3 border rounded-xl bg-white">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" name="update" 
                        class="px-5 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 shadow">
                    Update
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
