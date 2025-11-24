<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$anggota = mysqli_query($conn, "SELECT * FROM anggota ORDER BY divisi ASC, nama ASC");
$total_anggota = mysqli_num_rows($anggota);

// Warna divisi (bisa dikustom)
$divisi_warna = [
    'Ketua' => 'bg-red-100 text-red-800',
    'Wakil' => 'bg-orange-100 text-orange-800',
    'Sekretaris' => 'bg-yellow-100 text-yellow-800',
    'Bendahara' => 'bg-green-100 text-green-800',
    'Acara' => 'bg-blue-100 text-blue-800',
    'Dokumentasi' => 'bg-purple-100 text-purple-800',
    'Humas' => 'bg-pink-100 text-pink-800',
    'Media' => 'bg-indigo-100 text-indigo-800',
    'Kewirausahaan' => 'bg-teal-100 text-teal-800',
    'default' => 'bg-gray-100 text-gray-800'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota — HimmaConnect Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .divisi-badge {
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
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                HC
            </div>
            <h1 class="text-xl font-bold text-blue-700">HimmaConnect <span class="text-sm text-gray-500">Admin</span></h1>
        </div>

        <div class="hidden md:flex items-center gap-6 text-gray-700">
            <a href="index.php" class="hover:text-blue-600">Dashboard</a>
            <a href="anggota.php" class="font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Anggota</a>
            <a href="kegiatan.php" class="hover:text-blue-600">Kegiatan</a>
            <a href="aspirasi.php" class="hover:text-blue-600">Aspirasi</a>

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
        <a href="anggota.php" class="py-3 px-4 rounded-lg bg-blue-50 text-blue-700 font-medium flex items-center gap-2">
            <i class="fa-solid fa-user-group"></i> Anggota
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
<div class="pt-24 pb-10 px-4 max-w-7xl mx-auto">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-user-group text-blue-600"></i> Data Anggota
            </h1>
            <p class="text-gray-600 mt-1">Kelola struktur kepengurusan & anggota aktif.</p>
        </div>
        <a href="tambah_anggota.php"
           class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                  text-white rounded-lg shadow flex items-center gap-1">
            <i class="fa-solid fa-user-plus"></i> Tambah Anggota
        </a>
    </div>

    <!-- STATS BADGE -->
    <div class="mb-6 flex flex-wrap gap-3">
        <div class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium">
            <i class="fa-solid fa-users mr-1"></i> Total Anggota: <span class="font-bold"><?= $total_anggota ?></span>
        </div>
    </div>

    <!-- ANGGOTA GRID (Mobile-first) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-8">
        <?php if ($total_anggota > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($anggota)): ?>
            <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition overflow-hidden group">
                <!-- Foto -->
                <div class="h-40 bg-gray-100 flex items-center justify-center">
                    <?php if (!empty($row['foto'])): ?>
                        <img src="../uploads/anggota/<?= htmlspecialchars($row['foto']) ?>" 
                             alt="<?= htmlspecialchars($row['nama']) ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="text-5xl text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Info -->
                <div class="p-4">
                    <h3 class="font-bold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($row['email']) ?></p>

                    <!-- Badge Divisi -->
                    <?php 
                    $div = htmlspecialchars($row['divisi']);
                    $warna = $divisi_warna[$div] ?? $divisi_warna['default'];
                    ?>
                    <span class="divisi-badge <?= $warna ?> mt-2 inline-block">
                        <i class="fa-solid fa-tag text-xs"></i> <?= $div ?>
                    </span>

                    <!-- Aksi (muncul saat hover di desktop / selalu di mobile) -->
                    <div class="mt-4 flex gap-2">
                        <a href="edit_anggota.php?id_anggota=<?= $row['id_anggota'] ?>"
                           class="flex-1 px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm text-center transition">
                            <i class="fa-solid fa-edit text-xs mr-1"></i> Edit
                        </a>
                        <a href="hapus_anggota.php?id_anggota=<?= $row['id_anggota'] ?>"
                           onclick="return confirm('⚠️ Yakin hapus <?= addslashes($row['nama']) ?>?\nData tidak bisa dikembalikan.')"
                           class="flex-1 px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm text-center transition">
                            <i class="fa-solid fa-trash-can text-xs mr-1"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
        <div class="col-span-4 bg-white rounded-xl shadow border py-16 text-center">
            <div class="text-5xl text-gray-300 mb-4">
                <i class="fa-regular fa-user-group"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 mb-2">Belum ada anggota terdaftar</h3>
            <p class="text-gray-500 max-w-md mx-auto px-4">
                Tambahkan anggota pertama untuk membangun struktur kepengurusan.
            </p>
            <a href="tambah_anggota.php"
               class="mt-4 inline-block px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                <i class="fa-solid fa-user-plus mr-1"></i> Tambah Anggota
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- TABLE VIEW (Opsional — untuk export/cetak) -->
    <details class="bg-white rounded-xl shadow border mt-6">
        <summary class="px-5 py-3 text-sm font-medium text-gray-700 cursor-pointer flex items-center gap-2">
            <i class="fa-solid fa-table"></i> Tampilkan versi tabel (untuk cetak/export)
        </summary>
        <div class="p-4 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Foto</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Divisi</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    // Reset cursor karena sudah di-loop di atas
                    mysqli_data_seek($anggota, 0);
                    while ($row = mysqli_fetch_assoc($anggota)):
                    ?>
                    <tr>
                        <td class="px-4 py-2">
                            <?php if (!empty($row['foto'])): ?>
                                <img src="../uploads/anggota/<?= htmlspecialchars($row['foto']) ?>" 
                                     class="w-8 h-8 rounded-full object-cover">
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 font-medium"><?= htmlspecialchars($row['nama']) ?></td>
                        <td class="px-4 py-2">
                            <span class="divisi-badge <?= $divisi_warna[htmlspecialchars($row['divisi'])] ?? $divisi_warna['default'] ?>">
                                <?= htmlspecialchars($row['divisi']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="px-4 py-2">
                            <a href="edit_anggota.php?id_anggota=<?= $row['id_anggota'] ?>" class="text-blue-600 mr-3">Edit</a>
                            <a href="hapus_anggota.php?id_anggota=<?= $row['id_anggota'] ?>" class="text-red-600">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </details>

    <div class="mt-6 text-sm text-gray-500 text-center">
        <i class="fa-solid fa-shield-check text-green-500 mr-1"></i>
        Data anggota hanya digunakan untuk keperluan internal organisasi.
    </div>

</div>

</body>
</html>