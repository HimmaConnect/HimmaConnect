<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$anggota = mysqli_query($conn, "SELECT * FROM anggota ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota - Admin HimaConnect</title>
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
            <a href="anggota.php" class="font-semibold text-blue-600">Anggota</a>
            <a href="kegiatan.php" class="hover:text-blue-600">Kegiatan</a>
            <a href="aspirasi.php" class="hover:text-blue-600">Aspirasi</a>

            <a href="logout.php" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
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
        <a href="anggota.php" class="py-2 font-semibold text-blue-600">Anggota</a>
        <a href="kegiatan.php" class="py-2 text-gray-700">Kegiatan</a>
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
        <h2 class="text-3xl font-bold text-gray-800">Data Anggota</h2>

        <a href="tambah_anggota.php"
           class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
           + Tambah Anggota
        </a>
    </div>

    <!-- TABLE BOX -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border">
        <div class="overflow-x-auto">
 <table class="w-full">
    <thead>
        <tr class="bg-blue-700 text-white text-sm">
            <th class="p-4 text-center w-14 rounded-tl-2xl">No</th>
            <th class="p-4 text-center w-80">Foto</th>
            <th class="p-4 text-left">Nama</th>
            <th class="p-4 text-left whitespace-nowrap">NIM</th>
            <th class="p-4 text-left whitespace-nowrap">Prodi</th>
            <th class="p-4 text-left w-80">Email</th>
            <th class="p-4 text-center w-32 rounded-tr-2xl">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        if (mysqli_num_rows($anggota) > 0) {
            while ($row = mysqli_fetch_assoc($anggota)) {
        ?>

        <tr class="border-b hover:bg-gray-50">
            <td class="p-4 text-center"><?= $no++ ?></td>

            <!-- FOTO -->
            <td class="p-4 text-center">
                <?php if (!empty($row['foto'])) { ?>
                    <img src="../uploads/anggota/<?= $row['foto'] ?>" 
                         class="w-12 h-12 rounded-full object-cover mx-auto">
                <?php } else { ?>
                    <span class="text-gray-400 text-sm">-</span>
                <?php } ?>
            </td>

            <td class="p-4 font-medium"><?= htmlspecialchars($row['nama']) ?></td>
            <td class="p-4 whitespace-nowrap"><?= htmlspecialchars($row['nim']) ?></td>
            <td class="p-4 whitespace-nowrap"><?= htmlspecialchars($row['prodi']) ?></td>
            <td class="p-4 whitespace-nowrap"><?= htmlspecialchars($row['email']) ?></td>

            <td class="p-4 flex justify-center gap-2">
                <a href="edit_anggota.php?id_anggota=<?= $row['id_anggota'] ?>"
                   class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow text-sm">
                   Edit
                </a>

                <a href="hapus_anggota.php?id_anggota=<?= $row['id_anggota'] ?>"
                   onclick="return confirm('Yakin hapus anggota ini?')"
                   class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow text-sm">
                   Hapus
                </a>
            </td>
        </tr>

        <?php } } else { ?>

        <tr>
            <td colspan="7" class="p-6 text-center text-gray-500 text-lg">
                Belum ada data anggota 
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
