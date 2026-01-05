# 🏘️ Sistem Informasi Keuangan & Manajemen RT (SIM-RT)

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-v4-F2C94C?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![License](https://img.shields.io/badge/License-MIT-green)

Sistem manajemen keuangan dan data warga untuk Rukun Tetangga (RT) yang modern, transparan, dan otomatis. Dibangun menggunakan **Laravel 12** dan **FilamentPHP v4**.

Aplikasi ini memiliki fitur unik **Auto-Dropping Dana**, di mana uang iuran yang dibayar warga akan otomatis dipecah (split) ke berbagai Pos Anggaran (misal: 80% ke Kas Satpam, 20% ke Kas Kebersihan) secara _real-time_ saat pembayaran diverifikasi.

## ✨ Fitur Unggulan

### 1. 💰 Manajemen Keuangan Cerdas (Auto-Dropping)

-   **Automatic Fund Allocation:** Sistem otomatis membagi uang iuran yang masuk ke pos-pos anggaran (Kas RT, Sosial, Pembangunan, dll) sesuai persentase atau nominal tetap yang disetting di master data.
-   **Pencatatan Pengeluaran Terintegrasi:** Input pengeluaran yang otomatis memotong saldo Pos Anggaran terkait.
-   **Log Mutasi Dana:** Mencatat setiap pergerakan uang (masuk/keluar) secara rinci untuk audit.

### 2. 👥 Monitoring & Data Warga

-   **Kartu Kendali Iuran (Matrix View):** Tampilan matriks satu layar untuk memantau status pembayaran warga (Januari s/d Desember) dengan indikator lunas/belum.
-   **Filter Canggih:** Filter matriks berdasarkan Tahun dan Jenis Iuran tanpa reload halaman yang berat.
-   **Manajemen Warga:** CRUD data warga yang lengkap.

### 3. 🌐 Portal Transparansi Publik

-   **Landing Page Warga:** Halaman depan yang bisa diakses publik tanpa login.
-   **Real-time Stats:** Menampilkan grafik pemasukan, pengeluaran, dan saldo kas bersih terkini.
-   **Rincian Pengeluaran:** Warga dapat melihat detail penggunaan dana (Tanggal, Keperluan, Nominal) secara transparan.

### 4. ⚡ Optimasi Performa (High Performance)

-   **Database Indexing:** Query data warga dan keuangan tetap cepat meski data mencapai ribuan baris.
-   **Eager Loading & Selective Query:** Mencegah masalah _N+1 Query_ dan menghemat penggunaan memori server.
-   **Caching Widget:** Dashboard statistik menggunakan cache untuk mengurangi beban database.

---

## 🛠️ Teknologi

-   **Framework:** Laravel 12
-   **Admin Panel:** FilamentPHP v4
-   **Frontend:** Blade, Tailwind CSS, Alpine.js
-   **Database:** MySQL / MariaDB

---

## ⚙️ Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

---

## 📦 Cara Instalasi

Ikuti langkah-langkah ini untuk menjalankan project di komputer lokal:

1. **Clone Repositori**
    ```bash
    git clone [https://github.com/username-anda/sim-rt-filament.git](https://github.com/username-anda/sim-rt-filament.git)
    cd sim-rt-filament
    ```
2. **Install Dependencies**

    ```bash
    composer install
    npm install

    ```

3. **Setup Environment Salin file .env.example menjadi .env dan atur koneksi database.**

    ```bash
    cp .env.example .env
    php artisan key:generate

    ```

4. **Migrate Database Jalankan migrasi untuk membuat tabel, relasi, dan indexing.**
    ```bash
    php artisan migrate
    ```
5. **Buat User Admin (Filament)**
    ```bash
    php artisan make:filament-user
    ```
6. **Jalankan Aplikasi**

    ```bash
    npm run build
    php artisan serve
    ```

## Buka browser dan akses:

## Halaman Publik: http://localhost:8000

## Panel Admin: http://localhost:8000/admin

## 📖 Panduan Penggunaan Singkat

A. Mengatur Alokasi Dana (Dropping)

    Masuk ke Admin Panel > Menu Pos Anggaran. Buat pos baru (misal: Kas Operasional, Dana Sosial).

    Masuk ke Menu Jenis Iuran. Buat atau Edit iuran.

    Pada bagian "Dropping / Alokasi Dana", tambahkan aturan pembagian.

          Contoh: Pos Kas Operasional -> Tipe Persen -> Nilai 90.

    Hasil: Saat warga membayar iuran (Status diubah jadi Lunas), sistem otomatis mencatat mutasi dana masuk ke pos tersebut.

B. Monitoring Pembayaran

    Masuk ke menu Monitoring Iuran.

    Gunakan filter di atas tabel untuk memilih Tahun dan Jenis Iuran.

    Tabel akan menampilkan checklist status pembayaran per bulan (Jan-Des) untuk setiap warga.

C. Mencatat Pengeluaran

        Masuk ke menu Jenis Pengeluaran. Tentukan sumber dananya (misal: Beli ATK mengambil dana dari Kas Operasional).

        Input transaksi di menu Pengeluaran.

        Hasil: Saldo Kas Operasional akan otomatis berkurang.

    🤝 Kontribusi

        Kontribusi sangat diterima! Silakan Fork repositori ini dan buat Pull Request untuk fitur baru atau perbaikan bug.
