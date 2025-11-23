<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kegiatan - Admin HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-700">HimaConnect Admin</h1>

        <!-- Desktop Menu -->
        <div class="hidden md:flex gap-6 items-center text-gray-700">
            <a href="index.php" class="hover:text-blue-600">Dashboard</a>
            <a href="anggota.php" class="hover:text-blue-600">Anggota</a>
            <a href="kegiatan.php" class="font-semibold text-blue-600">Kegiatan</a>
            <a href="aspirasi.php" class="hover:text-blue-600">Aspirasi</a>

            <a href="logout.php" 
               class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
               Logout
            </a>
        </div>

        <!-- Mobile Button -->
        <button onclick="toggleSidebar()" class="md:hidden text-gray-700 text-2xl">
            ☰
        </button>
    </div>
</nav>

<!-- SIDEBAR MOBILE -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg border-r
                        transform -translate-x-full transition duration-300 z-50 md:hidden">

    <div class="p-5 border-b">
        <h2 class="text-xl font-bold text-blue-700">Menu</h2>
    </div>

    <div class="p-4 flex flex-col gap-3">
        <a href="index.php" class="py-2 text-gray-700">Dashboard</a>
        <a href="anggota.php" class="py-2 text-gray-700">Anggota</a>
        <a href="kegiatan.php" class="font-semibold text-blue-600 py-2">Kegiatan</a>
        <a href="aspirasi.php" class="py-2 text-gray-700">Aspirasi</a>
        <a href="logout.php" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Logout</a>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
}
</script>

<!-- CONTENT -->
<div class="pt-24 px-6 pb-10 max-w-full mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Data Kegiatan</h2>

        <a href="tambah_kegiatan.php"
           class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
           + Tambah Kegiatan
        </a>
    </div>

    <!-- TABLE BOX -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-blue-700 text-white text-sm">
                        <th class="p-4 text-center w-14 rounded-tl-2xl">No</th>
                        <th class="p-4 text-left">Judul</th>
                        <th class="p-4 text-left w-96">Deskripsi</th>
                        <th class="p-4 text-left whitespace-nowrap">Tanggal</th>
                        <th class="p-4 text-left whitespace-nowrap">Gambar</th>
                        <th class="p-4 text-center w-40 rounded-tr-2xl">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($kegiatan) > 0) {
                        while ($row = mysqli_fetch_assoc($kegiatan)) {
                    ?>

                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4 text-center"><?= $no++ ?></td>

                        <td class="p-4 font-medium"><?= htmlspecialchars($row['judul']) ?></td>

                        <td class="p-4">
                            <?= substr(strip_tags($row['deskripsi']), 0, 80) ?>...
                        </td>

                        <td class="p-4"><?= htmlspecialchars($row['tanggal']) ?></td>

                        <td class="p-4">
                            <?php if (!empty($row['gambar'])) { ?>
                                <img src="../uploads/<?= $row['gambar'] ?>" 
                                     class="w-24 h-16 object-cover rounded-lg shadow-sm">
                            <?php } else { ?>
                                <span class="text-gray-500">Tidak ada</span>
                            <?php } ?>
                        </td>

                        <td class="p-4 flex justify-center gap-2">
                            <a href="edit_kegiatan.php?id=<?= $row['id_kegiatan'] ?>"
                               class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow text-sm">
                               Edit
                            </a>

                            <a href="hapus_kegiatan.php?id=<?= $row['id_kegiatan'] ?>"
                               onclick="return confirm('Yakin hapus kegiatan ini?')"
                               class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow text-sm">
                               Hapus
                            </a>
                        </td>
                    </tr>

                    <?php } } else { ?>

                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500 text-lg">
                            Belum ada kegiatan 
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
