<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: kegiatan.php");
    exit;
}

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_kegiatan='$id'")
);

if (!$data) {
    header("Location: kegiatan.php");
    exit;
}

if (isset($_POST['update'])) {
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

        // Hapus gambar lama (opsional)
        if (!empty($data['gambar']) && file_exists($folder . $data['gambar'])) {
            unlink($folder . $data['gambar']);
        }
    } else {
        $gambar = $data['gambar']; // pertahankan gambar lama
    }

    $query = "UPDATE kegiatan 
              SET judul='$judul', deskripsi='$deskripsi', tanggal='$tanggal', gambar='$gambar' 
              WHERE id_kegiatan='$id'";

    mysqli_query($conn, $query);
    header("Location: kegiatan.php?status=edited");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan — Admin HimaConnect</title>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Header Fixed -->
<div class="bg-white shadow-sm border-b py-3 px-4 fixed top-0 left-0 right-0 z-50">
    <h1 class="text-lg font-bold text-blue-700">Edit Kegiatan</h1>
</div>

<!-- Konten Utama -->
<div class="pt-20 px-4 pb-8">

    <div class="bg-white p-5 shadow rounded-xl border">

        <h2 class="text-xl font-bold mb-5 text-gray-800">Edit Kegiatan</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">

            <!-- Judul -->
            <div>
                <label class="block font-semibold mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="5" required
                          class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                          placeholder="Jelaskan kegiatan secara singkat..."><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            </div>

            <!-- Tanggal -->
            <div>
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']) ?>" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block font-semibold mb-1">Gambar Saat Ini</label>
                <?php if (!empty($data['gambar']) && file_exists("../uploads/" . $data['gambar'])): ?>
                    <div class="flex justify-center mb-3">
                        <img src="../uploads/<?= htmlspecialchars($data['gambar']) ?>" 
                             class="w-28 h-28 object-cover rounded-lg border shadow-sm"
                             alt="Gambar kegiatan">
                    </div>
                <?php else: ?>
                    <p class="text-center text-gray-500 text-sm mb-3">Belum ada gambar</p>
                <?php endif; ?>

                <label class="block font-semibold mb-1">Ganti Gambar (Opsional)</label>
                <input type="file" name="gambar"
                       class="w-full p-3 border rounded-lg bg-white">
            </div>

            <!-- Tombol -->
            <div class="flex flex-col gap-3 pt-2">
                <button type="submit" name="update"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                    Update
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