# HimmaConnect

HimmaConnect adalah platform manajemen informasi resmi untuk Himpunan Mahasiswa (HIMA). Platform ini dirancang untuk memudahkan akses mahasiswa terhadap kegiatan, event, serta menyediakan saluran aspirasi yang transparan dan terpusat — semua dalam satu sistem web sederhana yang dapat dijalankan secara lokal maupun di server.

## Fitur Utama

- **Manajemen Kegiatan**  
  Tampilkan, tambah, edit, dan hapus kegiatan HIMA seperti seminar, lomba, rekrutmen, dan turnamen olahraga.

- **Sistem Aspirasi Online**  
  Mahasiswa dapat mengirimkan masukan, kritik, atau saran yang akan diterima langsung oleh admin.

- **Manajemen Anggota & Struktur Organisasi**  
  Kelola data anggota HIMA, divisi, dan peran masing-masing pengurus.

- **Antarmuka Admin**  
  Panel administrasi untuk mengelola seluruh konten: kegiatan, aspirasi, dan anggota.

- **Responsif & Modern**  
  Tampilan bersih dan responsif, cocok digunakan di desktop maupun perangkat mobile.

## Teknologi & Lingkungan Pengembangan

- Backend: PHP (native, tanpa framework)  
- Database: MySQL (dikelola melalui `config/koneksi.php`)  
- Frontend: HTML, CSS, JavaScript (minimalist, tanpa library eksternal berat)  
- Hosting Lokal: Kompatibel dengan **XAMPP**  
- File Upload: Mendukung upload gambar/berkas via folder `uploads`

## Struktur Folder
HimmaConnect/
├── admin/ # Panel administrasi
│ ├── index.php # Dashboard admin
│ ├── login.php # Login admin
│ ├── logout.php # Logout session
│ ├── kegiatan.php # Daftar kegiatan
│ ├── tambah_kegiatan.php # Form tambah kegiatan
│ ├── edit_kegiatan.php # Form edit kegiatan
│ ├── hapus_kegiatan.php # Proses hapus kegiatan
│ ├── anggota.php # Daftar anggota
│ ├── tambah_anggota.php # Form tambah anggota
│ ├── edit_anggota.php # Form edit anggota
│ ├── hapus_anggota.php # Proses hapus anggota
│ └── aspirasi.php # Daftar aspirasi
│ └── edit_aspirasi.php # Form edit aspirasi
│ └── hapus_aspirasi.php # Proses hapus aspirasi
│
├── config/
│ └── koneksi.php # Konfigurasi koneksi database
│
├── assets/
│ └── img/
│ └── organisasi-bg.jpeg # Gambar latar belakang
│
├── uploads/ # Penyimpanan file upload (gambar, dokumen)
│
├── cek_aspirasi.php # Validasi dan proses submit aspirasi
├── detail_aspirasi_user.php # Detail aspirasi untuk pengunjung
├── detail_kegiatan.php # Detail kegiatan untuk pengunjung
├── save_aspirasi.php # Proses penyimpanan aspirasi
├── proses_balas.php # Proses balas aspirasi oleh admin
│
└── index.php # Halaman utama publik
1234

## Cara Menjalankan (Menggunakan XAMPP)

1. Salin seluruh folder proyek ke direktori `htdocs` XAMPP:  
C:\xampp\htdocs\HimmaConnect

C:\xampp\htdocs\HimmaConnect

2. Buat database MySQL baru bernama `himmaconnect`.

3. Impor struktur database dari file SQL (jika ada), atau buat tabel manual:
- `kegiatan`
- `anggota`
- `aspirasi`

4. Edit konfigurasi database di `config/koneksi.php`:
```php

Jalankan Apache dan MySQL melalui XAMPP Control Panel.
Buka browser dan akses:
http://localhost/HimmaConnect/

## Link yang sudah di Hosting
https://mochakbarsiahaan.pplgsmkn4.my.id/HimmaConnect-main/
