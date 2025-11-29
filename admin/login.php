<?php
// --- WAJIB: TIDAK ADA KARAKTER DI ATAS BARIS INI ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $cek = $result->num_rows;

    if ($cek > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - HimaConnect</title>
    <link rel="shortcut icon" href="../assets/img/oxvi.jpg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center px-4">

<div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-7">

    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-50 mb-3">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-slate-800">Login Admin</h1>
    </div>

    <?php if (isset($error)): ?>
        <div class="mb-5 p-3 bg-red-50 text-red-700 text-sm rounded-lg border border-red-200">
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Username</label>
            <input type="text" name="username" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
            Masuk
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-slate-200">
        <a href="../index.php" class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-slate-700 py-2.5 rounded-xl transition">
            Kembali ke Beranda
        </a>
    </div>

</div>

</body>
</html>