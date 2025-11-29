# HimmaConnect

HimmaConnect adalah platform manajemen informasi resmi untuk Himpunan Mahasiswa (HIMA). Website ini dibuat untuk mengikuti *Lomba Coding Web* dengan tema "Website untuk organisasi/himpunan kampus".

Website ini menyediakan fitur lengkap mulai dari manajemen kegiatan, berita, hingga aspirasi mahasiswa. Dibangun dengan fokus pada fungsionalitas, UI/UX, inovasi, serta kerapihan kode sesuai poin penilaian lomba.

---

## 🚀 Fitur Utama

### 1. *Manajemen Kegiatan*

* Admin dapat menambahkan, mengedit, dan menghapus kegiatan.
* Ditampilkan dalam antarmuka yang rapi dan responsif.

### 2. *Manajemen Berita & Pengumuman*

* Menampilkan informasi terbaru untuk mahasiswa.

### 3. *Aspirasi Mahasiswa*

* Mahasiswa dapat mengirim aspirasi melalui form.
* Fitur cek aspirasi berdasarkan email.

### 4. *Sistem Login Admin*

* Autentikasi sederhana namun aman.
* Menggunakan session untuk memastikan halaman admin tidak bisa diakses tanpa login.

### 5. *Responsif untuk Semua Device*

* Tampilan sudah dioptimalkan untuk PC maupun HP.

---

## 🛠 Teknologi yang Digunakan

* *Frontend:* HTML5, Tailwind CSS, JavaScript
* *Backend:* PHP
* *Database:* MySQL
* *Hosting:* cPanel / PPLG Hosting

---

## 📂 Struktur Folder

```
HimmaConnect/
├── admin/                 # Panel administrasi
│   ├── index.php          # Dashboard admin
│   ├── login.php          # Login admin
│   ├── logout.php         # Logout session
│   ├── kegiatan.php       # Daftar kegiatan
│   ├── tambah_kegiatan.php# Form tambah kegiatan
│   ├── edit_kegiatan.php  # Form edit kegiatan
│   ├── hapus_kegiatan.php # Proses hapus kegiatan
│   ├── anggota.php        # Daftar anggota
│   ├── tambah_anggota.php # Form tambah anggota
│   ├── edit_anggota.php   # Form edit anggota
│   ├── hapus_anggota.php  # Proses hapus anggota
│   ├── aspirasi.php       # Daftar aspirasi
│   ├── edit_aspirasi.php  # Form edit aspirasi
│   └── hapus_aspirasi.php # Proses hapas aspirasi
│
├── config/
│   └── koneksi.php        # Konfigurasi koneksi database
│
├── assets/
│   └── img/
│       └── organisasi-bg.jpeg
│
├── uploads/               # Penyimpanan file upload
│
├── cek_aspirasi.php       # Validasi & submit aspirasi
├── detail_aspirasi_user.php
├── detail_kegiatan.php
├── save_aspirasi.php      # Proses penyimpanan aspirasi
├── proses_balas.php       # Proses balas aspirasi admin
└── index.php              # Halaman utama publik
```




---

## 📑 Dokumentasi Fitur
### 🔹 *1. Halaman User*
- Beranda
- Kegiatan
- Berita
- Aspirasi (kirim & cek)

### 🔹 *2. Halaman Admin*
- Login admin
- CRUD Kegiatan
- CRUD Berita
- Kelola aspirasi

---

## 💡 Inovasi dalam Project
- Sistem *cek aspirasi otomatis* berdasarkan email.
- *UI clean & modern* dengan dark mode.
- *Keamanan dasar login* agar halaman penting tidak bisa diakses sembarangan.
- Loading ringan dan cepat.

---

## 📸 Demo Online
Website dapat diakses melalui:
**https://mochakbarsiahaan.pplgsmkn4.my.id/HimmaConnect/ **

---

## 🧪 Cara Menjalankan Secara Lokal
1. Clone atau download project.
2. Pindahkan ke folder htdocs/ (jika menggunakan XAMPP).
3. Import database himma.sql ke phpMyAdmin.
4. Atur koneksi di config/koneksi.php.
5. Jalankan di browser: http://localhost/HimmaConnect/.

---

## 👥 Tim Pengembang
- *Mohammad Akbar Siahaan* (Fullstack Developer)
- *Muhammad Nabil Aufa Syukur* (Frontend & Dokumentasi)
- *Rayhan Ramadhan* (Backend & Database)

---

## 🏁 Status Project
Selesai untuk kebutuhan lomba coding dan siap didemokan secara langsung sesuai aturan.

---

## 📄 Lisensi
Project ini dibuat khusus untuk lomba dan penggunaan internal organisasi. Tidak diperjualbelikan.

---

Terima kasih telah membaca dokumentasi ini!

```
