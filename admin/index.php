<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config/koneksi.php';

// Hitung statistik
$total_kegiatan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kegiatan"));
$total_anggota   = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota"));

// 🔹 Hitung aspirasi berdasarkan kolom `balasan` (kosong = pending, isi = terjawab)
$result = mysqli_query($conn, "
    SELECT 
        COUNT(*) AS total,
        SUM(CASE WHEN balasan IS NULL OR TRIM(balasan) = '' THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN balasan IS NOT NULL AND TRIM(balasan) != '' THEN 1 ELSE 0 END) AS terjawab
    FROM aspirasi
");
$stats = mysqli_fetch_assoc($result);

$pending_aspirasi = (int) $stats['pending'];
$terjawab_aspirasi = (int) $stats['terjawab'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — HimmaConnect</title>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .icon-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- NAVBAR -->
<nav class="bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                HC
            </div>
            <h1 class="text-xl font-bold text-blue-700">HimmaConnect <span class="text-sm text-gray-500">Admin</span></h1>
        </div>

        <div class="hidden md:flex items-center gap-6 text-gray-700">
            <a href="index.php" class="font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Dashboard</a>
            <a href="anggota.php" class="hover:text-blue-600 transition">Anggota</a>
            <a href="kegiatan.php" class="hover:text-blue-600 transition">Kegiatan</a>
            <a href="aspirasi.php" class="hover:text-blue-600 transition">Aspirasi</a>

            <a href="logout.php"
               class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 
                      text-white rounded-lg shadow hover:shadow-md transition flex items-center gap-1">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>

        <button onclick="toggleSidebar()" class="md:hidden text-gray-700 text-xl">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</nav>

<!-- SIDEBAR MOBILE -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg border-r
                        transform -translate-x-full transition duration-300 z-50 md:hidden">
    <div class="p-5 border-b flex items-center gap-2">
        <div class="w-8 h-8 bg-blue-600 rounded text-white flex items-center justify-center text-sm font-bold">HC</div>
        <h2 class="text-lg font-bold text-blue-700">Admin Menu</h2>
    </div>
    <div class="p-4 flex flex-col gap-2">
        <a href="index.php" class="py-3 px-4 rounded-lg bg-blue-50 text-blue-700 font-medium flex items-center gap-2">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="anggota.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-users"></i> Anggota
        </a>
        <a href="kegiatan.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-calendar-days"></i> Kegiatan
        </a>
        <a href="aspirasi.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-comments"></i> Aspirasi
        </a>
        <a href="logout.php"
           class="mt-4 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg flex items-center justify-center gap-2">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');
}
document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('sidebar');
    const btn = e.target.closest('button[onclick="toggleSidebar()"]');
    if (!sidebar.contains(e.target) && !btn && !sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.add('-translate-x-full');
    }
});
</script>

<!-- MAIN CONTENT -->
<div class="pt-24 pb-10 max-w-6xl mx-auto px-4">
    <div class="mb-2 flex items-center gap-2">
        <i class="fa-solid fa-chart-line text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
    </div>
    <p class="text-gray-600 mb-6">
        Selamat datang, <span class="font-semibold text-blue-700"><?= htmlspecialchars($_SESSION['admin']) ?></span>.  
        Kelola data organisasi secara efisien dari sini.
    </p>

    <!-- QUICK STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-700 text-sm font-medium">Total Kegiatan</p>
                    <p class="text-2xl font-bold text-blue-800 mt-1"><?= $total_kegiatan ?></p>
                </div>
                <div class="text-blue-500 text-3xl"><i class="fa-solid fa-calendar-check"></i></div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-700 text-sm font-medium">Anggota Terdaftar</p>
                    <p class="text-2xl font-bold text-green-800 mt-1"><?= $total_anggota ?></p>
                </div>
                <div class="text-green-500 text-3xl"><i class="fa-solid fa-user-group"></i></div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-orange-700 text-sm font-medium">Aspirasi Menunggu</p>
                    <p class="text-2xl font-bold text-orange-800 mt-1"><?= $pending_aspirasi ?></p>
                </div>
                <div class="text-orange-500 text-3xl"><i class="fa-solid fa-clock"></i></div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-700 text-sm font-medium">Sudah Dibalas</p>
                    <p class="text-2xl font-bold text-purple-800 mt-1"><?= $terjawab_aspirasi ?></p>
                </div>
                <div class="text-purple-500 text-3xl"><i class="fa-solid fa-check-circle"></i></div>
            </div>
        </div>
    </div>

    <!-- ACTION CARDS -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
        <i class="fa-solid fa-bolt text-blue-600"></i> Aksi Cepat
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="kegiatan.php" class="group">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="text-blue-500 text-4xl mb-3 transition-transform group-hover:-translate-y-1 icon-float">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-700 transition text-lg">Kelola Kegiatan</h3>
                    <p class="text-gray-600 text-sm mt-2">Buat, edit, atau hapus kegiatan HIMA.</p>
                </div>
                <div class="mt-auto bg-gray-50 py-3 text-center text-blue-600 font-medium text-sm">
                    <i class="fa-solid fa-arrow-right mr-1"></i> Buka
                </div>
            </div>
        </a>

        <a href="anggota.php" class="group">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="text-green-500 text-4xl mb-3 transition-transform group-hover:-translate-y-1 icon-float">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-green-700 transition text-lg">Data Anggota</h3>
                    <p class="text-gray-600 text-sm mt-2">Lihat & kelola daftar anggota aktif.</p>
                </div>
                <div class="mt-auto bg-gray-50 py-3 text-center text-green-600 font-medium text-sm">
                    <i class="fa-solid fa-arrow-right mr-1"></i> Buka
                </div>
            </div>
        </a>

        <a href="aspirasi.php" class="group">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="text-orange-500 text-4xl mb-3 transition-transform group-hover:-translate-y-1 icon-float">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-orange-700 transition text-lg">Aspirasi Masuk</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        <?php if ($pending_aspirasi > 0): ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                         bg-orange-100 text-orange-800">
                                <i class="fa-solid fa-exclamation-circle mr-1"></i> <?= $pending_aspirasi ?> menunggu
                            </span>
                        <?php else: ?>
                            Tidak ada aspirasi menunggu
                        <?php endif; ?>
                    </p>
                </div>
                <div class="mt-auto bg-gray-50 py-3 text-center text-orange-600 font-medium text-sm">
                    <i class="fa-solid fa-arrow-right mr-1"></i> Buka
                </div>
            </div>
        </a>
    </div>

    <div class="mt-12 text-center text-gray-500 text-sm">
        <i class="fa-solid fa-shield-check text-green-500 mr-1"></i>
        Session aktif sebagai admin • 
        <span class="font-mono"><?= date('d M Y') ?></span>
    </div>
</div>

</body>
</html>