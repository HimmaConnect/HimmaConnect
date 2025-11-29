<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY tanggal DESC");
$total_kegiatan = mysqli_num_rows($kegiatan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kegiatan — HimaConnect Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
            <a href="anggota.php" class="hover:text-blue-600">Anggota</a>
            <a href="kegiatan.php" class="font-semibold text-blue-600 border-b-2 border-blue-600 pb-1">Kegiatan</a>
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
        <a href="anggota.php" class="py-3 px-4 rounded-lg hover:bg-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-users"></i> Anggota
        </a>
        <a href="kegiatan.php" class="py-3 px-4 rounded-lg bg-blue-50 text-blue-700 font-medium flex items-center gap-2">
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
                <i class="fa-solid fa-calendar-days text-blue-600"></i> Data Kegiatan
            </h1>
            <p class="text-gray-600 mt-1">Kelola kegiatan HIMA: tambah, edit, atau hapus.</p>
        </div>
        <a href="tambah_kegiatan.php"
           class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                  text-white rounded-lg shadow flex items-center gap-1">
            <i class="fa-solid fa-plus"></i> Tambah Kegiatan
        </a>
    </div>

    <!-- STATS BADGE -->
    <div class="mb-6 flex flex-wrap gap-3">
        <div class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium">
            <i class="fa-solid fa-calendar-check mr-1"></i> Total Kegiatan: <span class="font-bold"><?= $total_kegiatan ?></span>
        </div>
    </div>

    <!-- TABLE -->
    <?php if ($total_kegiatan > 0): ?>
    <div class="bg-white rounded-xl shadow overflow-hidden border">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">#</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kegiatan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Preview</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($kegiatan)): ?>
                    <tr class="hover:bg-gray-50 transition group">
                        <td class="px-5 py-4 whitespace-nowrap text-gray-700 font-medium"><?= $no++ ?></td>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800"><?= htmlspecialchars($row['judul']) ?></p>
                            <p class="text-sm text-gray-600 line-clamp-2 max-w-md mt-1">
                                <?= strip_tags(substr($row['deskripsi'], 0, 120)) ?>…
                            </p>
                        </td>
                        <td class="px-5 py-4 text-gray-600 whitespace-nowrap">
                            <i class="fa-solid fa-calendar-day text-blue-500 mr-1"></i>
                            <?= date('d M Y', strtotime($row['tanggal'])) ?>
                        </td>
                        <td class="px-5 py-4">
                            <?php if (!empty($row['gambar'])): ?>
                                <div class="w-20 h-16 rounded-lg overflow-hidden border shadow-sm">
                                    <img src="../uploads/<?= htmlspecialchars($row['gambar']) ?>" 
                                         alt="Gambar kegiatan"
                                         class="w-full h-full object-cover">
                                </div>
                            <?php else: ?>
                                <span class="text-gray-400 text-sm">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center gap-2">
                                <a href="edit_kegiatan.php?id=<?= $row['id_kegiatan'] ?>"
                                   class="px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm shadow-sm transition flex items-center gap-1">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>
                              <a href="#" 
                                    onclick="hapusKegiatan(<?= $row['id_kegiatan'] ?>)" 
                                    class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm shadow-sm transition flex items-center gap-1">
                                    <i class="fa-solid fa-trash-can text-xs mr-1"></i> Hapus
                                </a>

                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-xl shadow border py-16 text-center">
        <div class="text-5xl text-gray-300 mb-4">
            <i class="fa-regular fa-calendar-days"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700 mb-2">Belum ada kegiatan</h3>
        <p class="text-gray-500 max-w-md mx-auto px-4">
            Tambahkan kegiatan pertama untuk memulai!
        </p>
        <a href="tambah_kegiatan.php"
           class="mt-4 inline-block px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
            <i class="fa-solid fa-plus mr-1"></i> Tambah Kegiatan
        </a>
    </div>
    <?php endif; ?>

    <div class="mt-6 text-sm text-gray-500 text-center">
        <i class="fa-solid fa-info-circle text-blue-500 mr-1"></i>
        Thumbnail gambar diambil dari folder <code>../uploads/</code>
    </div>
</div>

<!-- Alert delete -->
 <script>
function hapusKegiatan(id) {
Swal.fire({
        title: "Yakin hapus data ini?",
        text: "Aksi ini tidak bisa dibatalkan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "hapus_kegiatan.php?id=" + id;
        }
    });
}
</script>


<!-- SWEETALERT -->
 <?php if (isset($_GET['status'])): ?>
<script>
const status = "<?= $_GET['status'] ?>";

if (status === "added") {
    Swal.fire({
        icon: 'success',
        title: 'Kegiatan berhasil ditambahkan!',
        showConfirmButton: false,
        timer: 1800
    });
}

if (status === "edited") {
    Swal.fire({
        icon: 'success',
        title: 'Perubahan berhasil disimpan!',
        showConfirmButton: false,
        timer: 1800
    });
}

if (status === "deleted") {
    Swal.fire({
        icon: 'success',
        title: 'Kegiatan berhasil dihapus!',
        showConfirmButton: false,
        timer: 1800
    });
}
</script>
<?php endif; ?>


</body>
</html>