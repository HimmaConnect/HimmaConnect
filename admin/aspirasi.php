<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// Ambil data aspirasi
$aspirasi = mysqli_query($conn, "SELECT * FROM aspirasi ORDER BY tanggal DESC");
$total = mysqli_num_rows($aspirasi);

// Hitung status
$pending = 0;
$terjawab = 0;
$data_aspirasi = [];
if ($total > 0) {
    mysqli_data_seek($aspirasi, 0);
    while ($row = mysqli_fetch_assoc($aspirasi)) {
        $data_aspirasi[] = $row;
        if (empty(trim($row['balasan']))) $pending++;
        else $terjawab++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Aspirasi — HimmaConnect Admin</title>
<link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<style>
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}
</style>
</head>
<body class="bg-gray-50">

<!-- NAVBAR -->
<nav class="bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
<div class="max-w-full mx-auto px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">HC</div>
        <h1 class="text-xl font-bold text-blue-700">HimmaConnect <span class="text-sm text-gray-500">Admin</span></h1>
    </div>
    <div class="hidden md:flex items-center gap-6 text-gray-700">
        <a href="index.php" class="hover:text-blue-600">Dashboard</a>
        <a href="anggota.php" class="hover:text-blue-600">Anggota</a>
        <a href="kegiatan.php" class="hover:text-blue-600">Kegiatan</a>
        <a href="aspirasi.php" class="font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Aspirasi</a>
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
    <a href="index.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="anggota.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-users"></i> Anggota
    </a>
    <a href="kegiatan.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-calendar-days"></i> Kegiatan
    </a>
    <a href="aspirasi.php" class="py-3 px-4 rounded-lg bg-blue-50 text-blue-700 font-medium flex items-center gap-2">
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

// SweetAlert hapus aspirasi
function hapusAspirasi(id) {
    Swal.fire({
        title: "Yakin hapus aspirasi ini?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "hapus_aspirasi.php?id=" + id;
        }
    });
}
</script>

<!-- MAIN CONTENT -->
<div class="pt-24 pb-10 px-4 max-w-7xl mx-auto">
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-comments text-blue-600"></i> Kelola Aspirasi
        </h1>
        <p class="text-gray-600 mt-1">Kelola & tanggapi aspirasi mahasiswa secara efisien.</p>
    </div>
    <a href="../index.php#aspirasi" target="_blank"
       class="px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-lg flex items-center gap-1 text-sm">
        <i class="fa-solid fa-eye"></i> Lihat Form User
    </a>
</div>

<!-- STATS BADGE -->
<div class="mb-6 flex flex-wrap gap-3">
    <div class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium">
        <i class="fa-solid fa-inbox mr-1"></i> Total: <span class="font-bold"><?= $total ?></span>
    </div>
    <div class="px-4 py-2 bg-orange-50 text-orange-700 rounded-lg font-medium">
        <i class="fa-solid fa-clock mr-1"></i> Menunggu: <span class="font-bold"><?= $pending ?></span>
    </div>
    <div class="px-4 py-2 bg-green-50 text-green-700 rounded-lg font-medium">
        <i class="fa-solid fa-check-circle mr-1"></i> Terjawab: <span class="font-bold"><?= $terjawab ?></span>
    </div>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow overflow-hidden border">
<?php if ($total > 0): ?>
<div class="overflow-x-auto">
<table class="min-w-full divide-y divide-gray-200">
<thead class="bg-gray-50">
<tr>
<th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
<th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama & Email</th>
<th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aspirasi</th>
<th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
<th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
<th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-gray-200">
<?php $no=1; foreach ($data_aspirasi as $row): ?>
<tr class="hover:bg-gray-50 transition">
<td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800"><?= $no++ ?></td>
<td class="px-6 py-4">
<p class="font-semibold text-gray-800"><?= htmlspecialchars($row['nama']) ?></p>
<p class="text-sm text-gray-500"><?= htmlspecialchars($row['email']) ?></p>
</td>
<td class="px-6 py-4 max-w-xs">
<p class="text-gray-700"><?= nl2br(htmlspecialchars(substr($row['isi'],0,100))) ?>
<?php if (strlen($row['isi'])>100): ?>…<?php endif; ?></p>
</td>
<td class="px-6 py-4 text-gray-600 text-sm whitespace-nowrap">
<?= date('d M Y', strtotime($row['tanggal'])) ?><br>
<span class="text-xs text-gray-400"><?= date('H:i', strtotime($row['tanggal'])) ?></span>
</td>
<td class="px-6 py-4">
<?php if (empty(trim($row['balasan']))): ?>
<span class="status-badge bg-orange-100 text-orange-800">
<i class="fa-solid fa-clock"></i> Menunggu
</span>
<?php else: ?>
<span class="status-badge bg-green-100 text-green-800">
<i class="fa-solid fa-check"></i> Terjawab
</span>
<?php endif; ?>
</td>
<td class="px-6 py-4 whitespace-nowrap text-center">
<div class="flex justify-center gap-2">
<a href="edit_aspirasi.php?id=<?= $row['id_aspirasi'] ?>"
   class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm shadow-sm transition flex items-center gap-1">
   <i class="fa-solid fa-pencil"></i> Balas
</a>
<a href="#" onclick="hapusAspirasi(<?= $row['id_aspirasi'] ?>)"
   class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm shadow-sm transition flex items-center gap-1">
   <i class="fa-solid fa-trash-can"></i> Hapus
</a>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php else: ?>
<div class="text-center py-12 px-4">
<div class="text-5xl mb-4 text-gray-300">
<i class="fa-regular fa-comments"></i>
</div>
<h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada aspirasi</h3>
<p class="text-gray-500">Belum ada mahasiswa yang mengirimkan aspirasi.</p>
<a href="../index.php#aspirasi" target="_blank"
   class="mt-4 inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
   Lihat Form Pengiriman
</a>
</div>
<?php endif; ?>
</div>

<div class="mt-6 text-sm text-gray-500 text-center">
<i class="fa-solid fa-shield-check text-green-500 mr-1"></i>
Semua data aspirasi dilindungi dan hanya dapat dilihat oleh admin.
</div>
</div>

<!-- SWEETALERT STATUS -->
<?php if (isset($_GET['status'])): ?>
<script>
const status = "<?= $_GET['status'] ?>";
if (status === "edited") {
    Swal.fire({icon:'success', title:'Balasan berhasil disimpan!', showConfirmButton:false, timer:1800});
}
if (status === "deleted") {
    Swal.fire({icon:'success', title:'Aspirasi berhasil dihapus!', showConfirmButton:false, timer:1800});
}
</script>
<?php endif; ?>

</body>
</html>
