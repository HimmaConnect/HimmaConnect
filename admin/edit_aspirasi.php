<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: aspirasi.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM aspirasi WHERE id_aspirasi = $id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    header("Location: aspirasi.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi — Admin</title>
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
        textarea:focus { outline: none; }
    </style>
</head>
<body class="bg-gradient-to-b from-slate-50 to-slate-100 min-h-screen">

<div class="max-w-md mx-auto px-4 py-6">

  <!-- Header Badge -->
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

    <div class="p-5 space-y-5">

      <!-- Info Fields -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nama</p>
        <p class="mt-1 text-slate-800 font-medium"><?= htmlspecialchars($row['nama']) ?></p>
      </div>

      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Email</p>
        <p class="mt-1 text-slate-700 break-all"><?= htmlspecialchars($row['email']) ?></p>
      </div>

      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</p>
        <p class="mt-1 text-slate-800 font-medium">
          <?= date('d M Y, H:i', strtotime($row['tanggal'])) ?>
        </p>
      </div>

      <!-- Aspirasi -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Isi Aspirasi</p>
        <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700 leading-relaxed">
          <?= nl2br(htmlspecialchars($row['isi'])) ?>
        </div>
      </div>

      <!-- Balasan Form -->
      <div>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Balasan Admin</p>
        <form action="proses_balas.php" method="POST" class="mt-3">
          <input type="hidden" name="id" value="<?= (int)$row['id_aspirasi'] ?>">

          <textarea
            name="balasan"
            rows="4"
            placeholder="Tulis balasan untuk aspirasi ini…"
            class="w-full px-4 py-3 text-slate-800 bg-white border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
          ><?= htmlspecialchars($row['balasan']) ?></textarea>

          <button
            type="submit"
            class="mt-4 w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl shadow-sm hover:shadow-md hover:from-blue-700 hover:to-blue-800 active:scale-[0.99] transition-all duration-200"
          >
            Kirim Balasan
          </button>
        </form>
      </div>

    </div>

    <!-- Back Button -->
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50">
      <a href="aspirasi.php"
         class="block w-full py-2.5 text-center bg-slate-700 hover:bg-slate-800 text-white font-medium rounded-xl shadow-sm transition duration-200">
        ← Kembali ke Daftar Aspirasi
      </a>
    </div>

  </div>

</div>

</body>
</html>