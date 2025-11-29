<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_kegiatan = '$id'");
$k = mysqli_fetch_assoc($data);

if (!$k) {
    die("Kegiatan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $k['judul'] ?> - HimmaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/img/oxvi.jpg" type="image/x-icon">
</head>

<body class="bg-gray-50">

    <!-- HERO FULL IMAGE -->
    <div class="w-full h-[380px] md:h-[460px] overflow-hidden relative">
        <img src="uploads/<?= $k['gambar'] ?>" 
             onerror="this.src='assets/img/default-event.jpg'"
             class="w-full h-full object-cover brightness-75">
        
        <div class="absolute inset-0 flex items-center justify-center text-center px-6">
            <h1 class="text-white text-3xl md:text-5xl font-bold drop-shadow-2xl max-w-3xl leading-tight">
                <?= $k['judul'] ?>
            </h1>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="max-w-4xl mx-auto px-6 -mt-16 relative">

        <!-- MAIN CARD -->
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-10">

            <!-- Breadcrumb -->
            <a href="index.php#kegiatan" 
               class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Kegiatan</a>

            <!-- Date -->
            <p class="text-gray-500 text-sm mt-2">
                <?= date("d M Y", strtotime($k['tanggal'])) ?>
            </p>

            <!-- Divider -->
            <div class="h-px bg-gray-200 my-6"></div>

            <!-- Description -->
            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                <?= nl2br($k['deskripsi']) ?>
            </div>

        </div>

        <!-- Space -->
        <div class="py-8"></div>

        <!-- SHARE BUTTONS -->
        <div class="bg-white p-6 rounded-2xl shadow mb-10">

            <h3 class="text-lg font-semibold text-gray-800 mb-3">Bagikan Kegiatan Ini</h3>

            <div class="flex items-center gap-4">

                <!-- WhatsApp -->
                <a 
                    href="https://api.whatsapp.com/send?text=<?= urlencode($k['judul']) ?> - <?= urlencode('http://yourdomain.com/detail_kegiatan.php?id='.$k['id_kegiatan']) ?>" 
                    target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" 
                         class="w-10 h-10 hover:scale-110 transition">
                </a>

                <!-- Instagram -->
                <a 
                    href="https://www.instagram.com/?url=<?= urlencode('http://yourdomain.com/detail_kegiatan.php?id='.$k['id_kegiatan']) ?>" 
                    target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" 
                         class="w-10 h-10 hover:scale-110 transition">
                </a>

                <!-- Facebook -->
                <a 
                    href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://yourdomain.com/detail_kegiatan.php?id='.$k['id_kegiatan']) ?>" 
                    target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/1384/1384053.png" 
                         class="w-10 h-10 hover:scale-110 transition">
                </a>

                <!-- Twitter/X -->
                <a 
                    href="https://twitter.com/intent/tweet?url=<?= urlencode('http://yourdomain.com/detail_kegiatan.php?id='.$k['id_kegiatan']) ?>&text=<?= urlencode($k['judul']) ?>" 
                    target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/5968/5968958.png" 
                         class="w-10 h-10 hover:scale-110 transition">
                </a>

                <!-- LinkedIn -->
                <a 
                    href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode('http://yourdomain.com/detail_kegiatan.php?id='.$k['id_kegiatan']) ?>" 
                    target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/1384/1384014.png" 
                         class="w-10 h-10 hover:scale-110 transition">
                </a>

            </div>
        </div>

        <!-- RELATED POSTS -->
        <div class="bg-white p-8 rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-5 text-gray-800">Kegiatan Lainnya</h2>

            <div class="grid md:grid-cols-3 gap-6">
                <?php
                    $related = mysqli_query($conn, 
                        "SELECT * FROM kegiatan 
                        WHERE id_kegiatan != '$id' 
                        ORDER BY RAND() LIMIT 3"
                    );

                    while ($r = mysqli_fetch_assoc($related)):
                ?>

                <a href="detail_kegiatan.php?id=<?= $r['id_kegiatan'] ?>" 
                   class="block bg-gray-50 hover:bg-white hover:shadow-xl transition rounded-2xl overflow-hidden transform hover:scale-[1.03]">

                    <img src="uploads/<?= $r['gambar'] ?>" 
                         onerror="this.src='assets/img/default-event.jpg'"
                         class="w-full h-36 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 text-sm">
                            <?= htmlspecialchars($r['judul']) ?>
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            <?= date("d M Y", strtotime($r['tanggal'])) ?>
                        </p>
                    </div>
                </a>

                <?php endwhile; ?>
            </div>
        </div>

        <div class="py-10"></div>

    </div>

</body>
</html>
