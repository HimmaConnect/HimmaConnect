<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: cek_aspirasi.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']); // keamanan tambahan
$data = mysqli_query($conn, "SELECT * FROM aspirasi WHERE id_aspirasi = '$id'");
$asp = mysqli_fetch_assoc($data);

if (!$asp) {
    http_response_code(404);
    echo '<div class="max-w-md mx-auto mt-20 text-center p-4 text-slate-700">Data tidak ditemukan.</div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi — HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-b from-slate-50 to-slate-100 min-h-screen">

<div class="max-w-md mx-auto px-4 py-6">

  <!-- Header badge -->
  <div class="text-center mb-6">
    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 text-white mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    </div>
    <h1 class="text-xl font-bold text-slate-800">Detail Aspirasi</h1>
  </div>

  <!-- Card Detail -->
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <!-- Status Badge -->
    <div class="px-5 pt-5 pb-3">
      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
        <?php if (empty(trim($asp['balasan']))): ?>
          bg-amber-100 text-amber-800
        <?php else: ?>
          bg-emerald-100 text-emerald-800
        <?php endif; ?>">
        <?php if (empty(trim($asp['balasan']))): ?>
          Menunggu Balasan
        <?php else: ?>
          Sudah Dibalas
        <?php endif; ?>
      </span>
    </div>

    <!-- Info List -->
    <div class="px-5 py-4 space-y-5">

      <!-- Nama -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nama</p>
        <p class="mt-1 text-slate-800 font-medium"><?= htmlspecialchars($asp['nama']) ?></p>
      </div>

      <!-- Email -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Email</p>
        <p class="mt-1 text-slate-700 break-all"><?= htmlspecialchars($asp['email']) ?></p>
      </div>

      <!-- Tanggal -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</p>
        <p class="mt-1 text-slate-800 font-medium">
          <?= date('d M Y, H:i', strtotime($asp['tanggal'])) ?>
        </p>
      </div>

      <!-- Aspirasi -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Isi Aspirasi</p>
        <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700 leading-relaxed">
          <?= nl2br(htmlspecialchars($asp['isi'])) ?>
        </div>
      </div>

      <!-- Balasan -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Balasan Admin</p>
        <?php if (empty(trim($asp['balasan']))): ?>
          <div class="mt-2 bg-amber-50 border border-amber-200 rounded-xl p-4">
            <div class="flex items-start gap-2 text-amber-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              <span>Belum ada balasan dari admin. Terima kasih atas kesabaran Anda.</span>
            </div>
          </div>
        <?php else: ?>
          <div class="mt-2 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-emerald-800 leading-relaxed">
            <?= nl2br(htmlspecialchars($asp['balasan'])) ?>
          </div>
        <?php endif; ?>
      </div>

    </div>

    <!-- Action Button -->
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50">
      <a href="cek_aspirasi.php"
         class="w-full block text-center py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white font-medium rounded-xl shadow-sm transition duration-200">
        ← Kembali ke Daftar Aspirasi
      </a>
    </div>

  </div>

  <!-- Footer note (opsional) -->
  <p class="text-center text-xs text-slate-400 mt-6">
    HimaConnect • Platform Aspirasi Mahasiswa
  </p>

</div>

</body>
</html>