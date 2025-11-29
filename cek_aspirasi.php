<?php
include 'config/koneksi.php';

$hasil = null;

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $hasil = mysqli_query($conn, "SELECT * FROM aspirasi WHERE email='$email'");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cek Aspirasi Kamu - HimaConnect</title>
<link rel="shortcut icon" href="assets/img/oxvi.jpg" type="image/x-icon">
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
  .card-hover {
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  }
  .card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  }
</style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen">

<div class="max-w-md mx-auto px-4 py-6">

  <div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 text-white mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    </div>
    <h1 class="text-2xl font-bold text-slate-800">Cek Aspirasi Kamu</h1>
    <p class="text-slate-500 mt-2">Masukkan email untuk melihat riwayat aspirasi dan balasan.</p>
  </div>

  <!-- Form Input -->
  <form method="POST" class="mb-8">
    <div class="space-y-3">
      <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
      <div class="flex flex-col sm:flex-row gap-2">
        <input
          type="email"
          id="email"
          name="email"
          required
          placeholder="contoh@univ.ac.id"
          class="flex-1 px-4 py-3 text-slate-800 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
        />
        <button
          type="submit"
          class="px-5 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl shadow-sm hover:shadow-md hover:from-blue-700 hover:to-blue-800 active:scale-95 transition-all duration-200 whitespace-nowrap"
        >
          Cari Aspirasi
        </button>
      </div>
    </div>
  </form>

  <!-- Hasil Pencarian -->
  <?php if ($hasil && mysqli_num_rows($hasil) > 0): ?>
    <div class="space-y-5">
      <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
        <div class="card-hover bg-white rounded-2xl border border-slate-200 overflow-hidden">
          <div class="p-5">
            <div class="flex justify-between items-start">
              <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?>
              </span>
              <a href="detail_aspirasi_user.php?id=<?= $row['id_aspirasi'] ?>"
                 class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center gap-1">
                Detail
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>

            <h3 class="mt-4 font-semibold text-slate-800">Aspirasi</h3>
            <div class="mt-2 prose prose-sm max-w-none text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-200">
              <?= nl2br(htmlspecialchars($row['isi'])) ?>
            </div>

            <h3 class="mt-5 font-semibold text-slate-800">Balasan Admin</h3>
            <?php if (empty(trim($row['balasan']))): ?>
              <div class="mt-2 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                <div class="flex items-center gap-2 text-amber-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                  <span>Belum dibalas. Mohon bersabar.</span>
                </div>
              </div>
            <?php else: ?>
              <div class="mt-2 prose prose-sm max-w-none text-slate-700 bg-emerald-50 p-4 rounded-xl border border-emerald-200">
                <?= nl2br(htmlspecialchars($row['balasan'])) ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

  <?php elseif ($hasil !== null): ?>
    <div class="text-center py-12">
      <div class="inline-block p-4 bg-slate-100 rounded-full mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
      </div>
      <h3 class="text-lg font-medium text-slate-800">Tidak Ada Aspirasi</h3>
      <p class="text-slate-500 mt-2">Tidak ditemukan aspirasi dengan email yang dimasukkan.</p>
    </div>
  <?php endif; ?>

  <!-- Tombol Kembali -->
  <div class="mt-8">
    <a href="index.php"
       class="block w-full py-3.5 text-center bg-slate-700 hover:bg-slate-800 text-white font-medium rounded-xl shadow-sm hover:shadow transition duration-200">
      ← Kembali ke Beranda
    </a>
  </div>

</div>

</body>
</html>