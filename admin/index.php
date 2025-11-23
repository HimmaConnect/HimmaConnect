<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">

        <h1 class="text-xl font-bold text-blue-700">HimaConnect Admin</h1>

        <!-- Desktop Menu -->
        <div class="hidden md:flex gap-6 items-center text-gray-700">
            <a href="index.php" class="hover:text-blue-600 font-semibold text-blue-600">Dashboard</a>
            <a href="anggota.php" class="hover:text-blue-600">Anggota</a>
            <a href="kegiatan.php" class="hover:text-blue-600">Kegiatan</a>
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
        <a href="index.php" class="py-2 font-semibold text-blue-600">Dashboard</a>
        <a href="anggota.php" class="py-2 text-gray-700">Anggota</a>
        <a href="kegiatan.php" class="py-2 text-gray-700">Kegiatan</a>
        <a href="aspirasi.php" class="py-2 text-gray-700">Aspirasi</a>

        <a href="logout.php"
           class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Logout</a>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
}
</script>

<!-- CONTENT -->
<div class="pt-24 max-w-5xl mx-auto px-4">

    <h2 class="text-2xl font-bold mb-1">
        Selamat datang <span class="text-blue-700"><?php echo $_SESSION['admin']; ?></span>
    </h2>

    <p class="text-gray-600 mb-6">
        Kelola data kegiatan, anggota, forum, dan aspirasi di sini.
    </p>

    <!-- MENU GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Kegiatan -->
        <a href="kegiatan.php" 
           class="bg-white shadow hover:shadow-md transition p-6 rounded-xl text-center border border-gray-200">
            <div class="text-4xl mb-3">🗓️</div>
            <h3 class="font-semibold text-lg">Kelola Kegiatan</h3>
            <p class="text-sm text-gray-500 mt-1">Tambah, edit dan hapus kegiatan</p>
        </a>

        <!-- Anggota -->
        <a href="anggota.php" 
           class="bg-white shadow hover:shadow-md transition p-6 rounded-xl text-center border border-gray-200">
            <div class="text-4xl mb-3">👥</div>
            <h3 class="font-semibold text-lg">Data Anggota</h3>
            <p class="text-sm text-gray-500 mt-1">Daftar anggota aktif</p>
        </a>

        <!-- Aspirasi -->
        <a href="aspirasi.php" 
           class="bg-white shadow hover:shadow-md transition p-6 rounded-xl text-center border border-gray-200">
            <div class="text-4xl mb-3">💬</div>
            <h3 class="font-semibold text-lg">Aspirasi Masuk</h3>
            <p class="text-sm text-gray-500 mt-1">Saran & masukan dari pengguna</p>
        </a>

    </div>

</div>

</body>
</html>
