<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HimmaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awsome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

</head>
<body class="bg-gray-100">
<!-- CSS -->

<style>
@keyframes fadeUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.fade-up {
    animation: fadeUp 1s ease-out forwards;
}

@keyframes reveal {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
}
.reveal {
    opacity: 0;
}
.reveal.visible {
    animation: reveal .8s ease-out forwards;
}

@keyframes waveFloat {
    0% { transform: translateY(0); }
    50% { transform: translateY(8px); }
    100% { transform: translateY(0); }
}
.wave-anim {
    animation: waveFloat 5s ease-in-out infinite;
}
</style>

<!-- CSS -->


<!-- NAVBAR -->
<nav class="bg-white/80 backdrop-blur-md shadow-md fixed top-0 left-0 right-0 z-50 transition-all">
<div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">


<!-- LEFT LOGO + DROPDOWN -->
<div class="relative">
<button onclick="toggleProfile()" class="flex items-center gap-3 group">
<img
src="https://cdn-icons-png.flaticon.com/512/9131/9131529.png"
alt="HimmaConnect Logo"
class="w-10 h-10 rounded-full shadow-md group-hover:scale-105 transition"
>
<span class="font-semibold text-xl tracking-wide group-hover:text-blue-600 transition">HimmaConnect</span>
</button>


<!-- Dropdown Menu -->
<div id="profileMenu" class="hidden absolute left-0 mt-3 w-44 bg-white shadow-xl border rounded-xl py-2 animate-fadeIn">
<a href="admin/login.php" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Masuk Admin</a>
<a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dashboard</a>
</div>
</div>


<!-- RIGHT MENU DESKTOP -->
<ul class="hidden md:flex gap-8 text-gray-700 font-medium tracking-wide">
<li><a href="#tentang" class="hover:text-blue-600 transition">Tentang</a></li>
<li><a href="#kegiatan" class="hover:text-blue-600 transition">Kegiatan</a></li>
<li><a href="#aspirasi" class="hover:text-blue-600 transition">Aspirasi</a></li>
<li><a href="cek_aspirasi.php" class="hover:text-blue-600 transition">Cek Aspirasi</a></li>
</ul>


<!-- HAMBURGER MOBILE -->
<button id="hamburger" onclick="toggleMenu()" class="md:hidden focus:outline-none">
<div class="space-y-1.5">
<span class="block w-6 h-0.5 bg-gray-700"></span>
<span class="block w-6 h-0.5 bg-gray-700"></span>
<span class="block w-6 h-0.5 bg-gray-700"></span>
</div>
</button>
</div>




</nav>

<!-- MOBILE SIDEBAR -->
<div id="mobileSidebar" 
     class="fixed top-0 left-0 h-full w-64 bg-white shadow-xl transform -translate-x-full 
            transition-transform duration-300 z-50 md:hidden">

    <div class="px-6 py-5 border-b font-semibold text-lg">
        Menu
    </div>

    <ul class="flex flex-col py-3 text-gray-700 font-medium tracking-wide">
        <a href="#tentang" class="px-6 py-3 hover:bg-gray-100">Tentang</a>
        <a href="#kegiatan" class="px-6 py-3 hover:bg-gray-100">Kegiatan</a>
        <a href="#aspirasi" class="px-6 py-3 hover:bg-gray-100">Aspirasi</a>
        <a href="cek_aspirasi.php" class="px-6 py-3 hover:bg-gray-100">Cek Aspirasi</a>
    </ul>
</div>

<!-- OVERLAY MOBILE -->
<div id="mobileOverlay" 
     class="hidden fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden">
</div>
<!-- NAVBAR END -->

<!-- Spacer biar tidak ketutup navbar -->
<div class="h-20"></div>


    <!-- HERO SECTION -->
<section 
    class="w-full h-[80vh] bg-cover bg-center flex items-center" 
    style="background-image: url('assets/img/organisasi-bg.jpeg');">
    
    <div class="bg-black bg-opacity-50 w-full h-full flex items-center">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg fade-up">
                HimmaConnect
            </h1>
            <p class="text-white mt-4 text-lg md:text-xl max-w-2xl leading-relaxed drop-shadow fade-up"
               style="animation-delay: .2s;">
                Platform informasi resmi HIMA untuk mahasiswa. 
                Menyediakan akses cepat ke kegiatan, event, serta aspirasi 
                yang dapat kamu sampaikan langsung secara online.
            </p>

            <a href="#kegiatan" 
               class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-lg transition fade-up"
               style="animation-delay: .4s;">
               Lihat Kegiatan
            </a>
        </div>
    </div>
</section>
    <!-- HERO SECTION -->

<!-- SECTION TENTANG -->
<section id="tentang" class="pt-32 pb-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center">
            Tentang HimmaConnect
        </h2>

        <p class="mt-6 text-gray-600 text-lg leading-relaxed text-center max-w-3xl mx-auto">
            HimmaConnect adalah platform informasi resmi dari 
            <span class="font-semibold text-blue-600">Himpunan Mahasiswa</span> 
            yang bertujuan untuk menyediakan informasi kegiatan, event, 
            dan ruang aspirasi bagi seluruh mahasiswa.  
            Semua informasi dapat diakses dengan mudah, cepat, dan transparan.
        </p>

        <!-- 3 CARD PENJELASAN -->
        <div class="grid md:grid-cols-3 gap-8 mt-14">

            <!-- Card 1 -->
            <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-md transition">
                <h3 class="text-xl font-semibold text-gray-700">Informasi Terpusat</h3>
                <p class="mt-3 text-gray-600">
                    Semua kegiatan HIMA disajikan dalam satu tempat, mudah diakses kapan saja.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-md transition">
                <h3 class="text-xl font-semibold text-gray-700">Aspirasi Online</h3>
                <p class="mt-3 text-gray-600">
                    Mahasiswa dapat menyampaikan saran, kritik, dan masukan secara langsung.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="p-6 bg-gray-50 rounded-2xl shadow-sm hover:shadow-md transition">
                <h3 class="text-xl font-semibold text-gray-700">Transparan & Modern</h3>
                <p class="mt-3 text-gray-600">
                    Menampilkan kegiatan secara terbuka dengan tampilan modern dan responsif.
                </p>
            </div>

        </div>

    </div>
</section>
<!-- SECTION TENTANG -->

<!-- SECTION KEGIATAN -->
<section id="kegiatan" class="pt-32 pb-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center">
            Kegiatan Terbaru
        </h2>

        <p class="mt-4 text-gray-600 text-center max-w-2xl mx-auto">
            Lihat berbagai kegiatan, event, dan aktivitas terbaru dari HIMA.
        </p>

        <!-- CARD WRAPPER -->
        <div class="grid md:grid-cols-3 gap-8 mt-12">

            <?php
            include 'config/koneksi.php'; // SESUAIKAN PATH
            
            $data = mysqli_query($conn, "SELECT * FROM kegiatan ORDER BY tanggal DESC");

            if (mysqli_num_rows($data) == 0) {
                echo "
                <p class='text-center text-gray-600 col-span-3'>
                    Belum ada kegiatan untuk saat ini.
                </p>";
            }

            while($k = mysqli_fetch_assoc($data)):
            ?>

            <!-- CARD -->
            <div class="reveal bg-white p-5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition">
                
                <!-- GAMBAR -->
                <img 
                    src="uploads/<?= $k['gambar'] ?>" 
                    class="w-full h-48 object-cover"
                    onerror="this.src='assets/img/default-event.jpg'"
                >

                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-800">
                        <?= htmlspecialchars($k['judul']) ?>
                    </h3>

                    <p class="text-gray-600 text-sm mt-2">
                        <?= substr(htmlspecialchars($k['deskripsi']), 0, 120) ?>...
                    </p>

                    <p class="mt-3 text-gray-500 text-sm flex items-center gap-1">
                    <?= date("d M Y", strtotime($k['tanggal'])) ?>
                    </p>
                </div>
            </div>

            <?php endwhile; ?>

        </div>

    </div>
</section>
<!-- SECTION KEGIATAN -->

<!-- ASPIRASI SECTION -->
<section id="aspirasi" class="py-20 bg-gray-100">
    <div class="max-w-4xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-6">Sampaikan Aspirasi</h2>
        <p class="text-center text-gray-600 mb-10">
            Suaramu penting! Kirimkan aspirasi, kritik, atau saran yang akan diterima langsung oleh Admin HIMA.
        </p>

        <form action="save_aspirasi.php" method="POST" 
              class="bg-white p-8 rounded-xl shadow-lg space-y-5">

            <div>
                <label class="block font-semibold mb-1">Nama</label>
                <input type="text" name="nama" required
                    class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block font-semibold mb-1">Aspirasi</label>
                <textarea name="isi" rows="5" required
                    class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"></textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold p-3 rounded-lg">
                Kirim Aspirasi
            </button>

        </form>

    </div>
</section>


<!-- WAVES -->
<div class="w-full">
 <svg class="wave-anim" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2563eb" fill-opacity="1" d="M0,64L48,90.7C96,117
 ,192,171,288,160C384,149,480,75,576,69.3C672,64,768,128,864,170.7C960,213,1056,235,1152,213.3C1248,192,1344,128,1392,96L1440,64L1440
 ,320L1392,320C1344,320,1248,320,1152,320C1056
 ,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</div>

<!-- FOOTER -->
<footer class="bg-blue-600 text-white py-10">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">

    <div class="text-center md:text-left">
      <h2 class="text-2xl font-bold">HimmaConnect</h2>
      <p class="text-sm mt-1">Sarana Informasi • Kegiatan • Aspirasi Mahasiswa</p>
      <p class="text-xs mt-2 opacity-80">&copy; 2025 HimmaConnect — All rights reserved</p>
    </div>

    <!-- SOCIAL -->
    <div class="flex gap-4 text-2xl">
      <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-instagram"></i></a>
      <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-facebook"></i></a>
      <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-linkedin"></i></a>
      <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-x-twitter"></i></a>
    </div>

  </div>
</footer>
<!-- FOOTER -->



<!-- JS -->
<script>
    function toggleProfile() {
        document.getElementById("profileMenu").classList.toggle("hidden");
    }

    document.addEventListener("click", function (e) {
        const menu = document.getElementById("profileMenu");
        const buttonArea = e.target.closest("button");

        if (!buttonArea) {
            menu.classList.add("hidden");
        }
    });
</script>

<script>
function toggleMenu() {
    const sidebar = document.getElementById("mobileSidebar");
    const overlay = document.getElementById("mobileOverlay");

    if (sidebar.classList.contains("-translate-x-full")) {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
    } else {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
    }
}
</script>

<!-- scroll js -->
 <script>
const revealElements = document.querySelectorAll('.reveal');

function checkReveal() {
    const trigger = window.innerHeight - 80;

    revealElements.forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < trigger) {
            el.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', checkReveal);
window.addEventListener('load', checkReveal);
</script>

<!-- scroll js -->

</body>
</html>
