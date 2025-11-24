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
<!-- CSS ANIMASI -->

<style>

html {
    scroll-behavior: smooth;
}

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

/* Fade in + slide up */
@keyframes heroFade {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-animate {
  animation: heroFade 1.2s ease-out forwards;
}

@keyframes cardFade {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.card-animate {
  opacity: 0;
  animation: cardFade 0.9s ease-out forwards;
}
.card-animate:nth-child(1) { animation-delay: 0.1s; }
.card-animate:nth-child(2) { animation-delay: 0.2s; }
.card-animate:nth-child(3) { animation-delay: 0.3s; }
.card-animate:nth-child(4) { animation-delay: 0.4s; }
.card-animate:nth-child(5) { animation-delay: 0.5s; }
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
<span class="font-semibold text-xl tracking-wide group-hover:text-blue-300 transition">HimmaConnect</span>
</button>


<!-- Dropdown Menu -->
<div id="profileMenu" class="hidden absolute left-0 mt-3 w-44 bg-white shadow-xl border rounded-xl py-2 animate-fadeIn">
<a href="admin/login.php" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Masuk Admin</a>
<a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">Dashboard</a>
</div>
</div>


<!-- RIGHT MENU DESKTOP -->
<ul class="hidden md:flex gap-8 text-gray-700 font-medium tracking-wide">
<li><a href="#tentang" class="hover:text-blue-300 transition">Tentang</a></li>
<li><a href="#kegiatan" class="hover:text-blue-300 transition">Kegiatan</a></li>
<li><a href="#anggota" class="hover:text-blue-300 transition">Anggota</a></li>
<li><a href="#aspirasi" class="hover:text-blue-300 transition">Aspirasi</a></li>
<li><a href="cek_aspirasi.php" class="hover:text-blue-300 transition">Cek Aspirasi</a></li>
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
        <a href="#anggota" class="px-6 py-3 hover:bg-gray-100">Anggota</a>
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
        <div class="container mx-auto px-6 hero-animate">
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
              class="inline-block mt-6 px-6 py-3 rounded-lg shadow-lg text-white font-semibold 
                      bg-gradient-to-r from-blue-300 to-blue-900 
                      hover:from-blue-400 hover:to-blue-950 
                      transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
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
            <span class="font-semibold text-blue-800">Himpunan Mahasiswa</span> 
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
            include 'config/koneksi.php'; 
            
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
            <a href="detail_kegiatan.php?id=<?= $k['id_kegiatan'] ?>" class="block">
                <div class="reveal bg-white rounded-2xl shadow-md hover:shadow-xl 
                            transition transform hover:scale-[1.03] duration-300 
                            overflow-hidden">

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

                        <p class="mt-3 text-gray-500 text-sm">
                            <?= date("d M Y", strtotime($k['tanggal'])) ?>
                        </p>
                    </div>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- SECTION KEGIATAN -->


<!-- WAVES -->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 318">
  <defs>
    <linearGradient id="gradWaveSmooth" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#93c5fd" /> 
      <stop offset="100%" stop-color="#1e3a8a" />
    </linearGradient>
  </defs>

  <path 
    fill="url(#gradWaveSmooth)"
    d="M0,128C120,160,240,224,360,234.7C480,245,600,203,720,170.7C840,139,960,117,1080,117.3C1200,117,1320,139,1440,165.3L1440,320H0Z">
  </path>
</svg>
<!-- WAVES -->


<!-- SECTION ANGGOTA / PENGURUS -->
<section id="anggota" class="pt-32 pb-24 bg-blue-900">
  <div class="max-w-6xl mx-auto px-6">

    <!-- HEADER -->
    <div class="grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h2 class="text-4xl font-bold text-white leading-tight">
          Struktur Pengurus & Anggota HIMA
        </h2>
        <p class="mt-5 text-blue-100 text-lg leading-relaxed">
          Halaman ini menampilkan seluruh pengurus dan anggota aktif HIMA yang terbagi 
          ke dalam berbagai divisi seperti Acara, Dokumentasi, Humas, Media, dan lainnya.
          Setiap divisi memiliki peran penting dalam menjalankan kegiatan organisasi.
        </p>
      </div>

      <div class="flex justify-center">
        <img src="assets/img/team-illustration.svg"
             class="w-64 opacity-90 drop-shadow-xl" alt="">
      </div>
    </div>

    <!-- LIST DIVISI -->
    <div class="mt-16 space-y-6">

      <?php
      include 'config/koneksi.php';
      $divisiQuery = mysqli_query($conn, "SELECT DISTINCT divisi FROM anggota ORDER BY divisi ASC");
      ?>

      <?php while ($d = mysqli_fetch_assoc($divisiQuery)): ?>
      <?php
      $divisi = $d['divisi'];
      $anggota = mysqli_query($conn, "SELECT * FROM anggota WHERE divisi='$divisi'");
      ?>

      <!-- ACCORDION DIVISI -->
      <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
        <button 
          onclick="toggleDivisi('divisi-<?= $divisi ?>')" 
          class="w-full flex justify-between items-center p-5"
        >
          <h3 class="text-xl font-semibold text-blue-900"><?= $divisi ?></h3>
          <span id="icon-divisi-<?= $divisi ?>" class="text-slate-600 text-2xl font-bold">+</span>
        </button>

        <!-- CONTENT -->
        <div id="divisi-<?= $divisi ?>" class="hidden p-5 border-t space-y-4 bg-gray-50">

          <?php while ($a = mysqli_fetch_assoc($anggota)): ?>

          <!-- CARD ANGGOTA PREMIUM -->
          <div class="flex items-center gap-5 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-300 hover:shadow-md transition">
            <img src="uploads/anggota/<?= $a['foto'] ?>"
                 onerror="this.src='assets/img/default-user.png'"
                 class="w-20 h-20 rounded-full object-cover shadow-md">

            <div>
              <h4 class="text-lg font-bold text-slate-800"><?= $a['nama'] ?></h4>
              <p class="text-sm text-slate-600"><?= $a['email'] ?></p>
              <p class="text-xs text-slate-500 mt-1">Divisi: <?= $divisi ?></p>
            </div>
          </div>

          <?php endwhile; ?>
        </div>
      </div>

      <?php endwhile; ?>

    </div>

  </div>
</section>

<script>
function toggleDivisi(id) {
    let content = document.getElementById(id);
    let icon = document.getElementById("icon-" + id);

    if (content.classList.contains("hidden")) {
        content.classList.remove("hidden");
        icon.innerHTML = "−";
        icon.classList.add("text-blue-400");
    } else {
        content.classList.add("hidden");
        icon.innerHTML = "+";
        icon.classList.remove("text-blue-400");
    }
}
</script>
<!-- SECTION ANGGOTA / PENGURUS -->
<!-- WAVES -->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <defs>
    <linearGradient id="waveBottomGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1e3a8a" />   <!-- blue-900 -->
      <stop offset="100%" stop-color="#93c5fd" /> <!-- blue-300 -->
    </linearGradient>
  </defs>
  <path 
    fill="url(#waveBottomGrad)" 
    fill-opacity="1"
    d="M0,256L14.1,245.3C28.2,235,56,213,85,170.7C112.9,128,141,64,169,42.7C197.6,21,
    226,43,254,90.7C282.4,139,311,213,339,213.3C367.1,213,395,139,424,122.7C451.8,107,
    480,149,508,176C536.5,203,565,213,593,197.3C621.2,181,649,139,678,133.3C705.9,128,
    734,160,762,165.3C790.6,171,819,149,847,149.3C875.3,149,904,171,932,186.7C960,203,
    988,213,1016,192C1044.7,171,1073,117,1101,85.3C1129.4,53,1158,43,1186,53.3C1214.1,
    64,1242,96,1271,138.7C1298.8,181,1327,235,1355,256C1383.5,277,1412,267,1426,261.3L1440,
    256L1440,0L0,0Z">
  </path>
</svg>
<!-- WAVES -->




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
                class="w-full bg-blue-900 hover:bg-blue-700 text-white font-semibold p-3 rounded-lg">
                Kirim Aspirasi
            </button>

        </form>

    </div>
</section>


<!-- WAVES -->
<div class="w-full">
 <svg class="wave-anim" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 317"><path fill="#1e3a8a" fill-opacity="1" d="M0,64L48,90.7C96,117
 ,192,171,288,160C384,149,480,75,576,69.3C672,64,768,128,864,170.7C960,213,1056,235,1152,213.3C1248,192,1344,128,1392,96L1440,64L1440
 ,320L1392,320C1344,320,1248,320,1152,320C1056
 ,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</div>

<!-- FOOTER -->
<footer class="bg-blue-900 text-white py-10">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center md:items-start gap-6">

    <div class="text-center md:text-left max-w-sm">
      <h2 class="text-2xl font-bold">HimmaConnect</h2>
      <p class="text-sm mt-1">Sarana Informasi • Kegiatan • Aspirasi Mahasiswa</p>

      <!-- ALAMAT + LINK GOOGLE MAPS -->
      <p class="text-sm mt-3">
        <strong>Alamat:</strong><br>
        <a href="https://maps.app.goo.gl/AhRasBUddz3bf35n6"
           target="_blank"
           class="underline hover:text-gray-300">
           SMKN 4 Padalarang, Kertajaya, Kec. Padalarang, Kabupaten Bandung Barat, Jawa Barat 40553
        </a>
      </p>

      <p class="text-xs mt-3 opacity-80">&copy; 2025 HimmaConnect — All rights reserved</p>
    </div>

    <!-- SOCIAL -->
    <div class="flex gap-4 text-2xl">
      <a href="https://www.instagram.com/" class="hover:text-gray-300"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://web.facebook.com/?locale=id_ID&_rdc=1&_rdr#" class="hover:text-gray-300"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://id.linkedin.com/" class="hover:text-gray-300"><i class="fa-brands fa-linkedin"></i></a>
      <a href="https://x.com/?lang=id" class="hover:text-gray-300"><i class="fa-brands fa-x-twitter"></i></a>
    </div>

  </div>
</footer>
<!-- FOOTER -->



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
