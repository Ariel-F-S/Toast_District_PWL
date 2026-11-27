# 🍞 Toast.district — Sistem Digitalisasi Operasional & Pemasaran

> **A little toast, a lot of happiness.**  
> Aplikasi web terintegrasi untuk manajemen katalog produk, pemesanan online & catering dengan pembayaran **QRIS (Midtrans)**, kasir offline (POS), manajemen pesanan, serta laporan keuangan otomatis.

Proyek ini dikembangkan sebagai tugas mata kuliah **Pemrograman Web Lanjut (PWL)** — Program Studi **D3 Manajemen Informatika, Politeknik Negeri Malang PSDKU Kediri**, bermitra langsung dengan usaha kuliner **Toast.district** (Kota Kediri, Jawa Timur).

---

## 🛠️ Tech Stack

* **Backend Framework:** Laravel 11 / 12 (PHP 8.2+)
* **Authentication:** Laravel Fortify (Custom UI & Role-Based Redirect)
* **Frontend:** Blade Templating, Bootstrap 5.3, Bootstrap Icons, Custom Editorial CSS
* **Database:** MySQL (Laragon)
* **Payment Gateway:** Midtrans (QRIS & Snap Integration)
* **Export Reporting:** Maatwebsite Excel (`.xlsx`) & DomPDF (`.pdf`)

---

## ✨ Fitur Utama Sistem

### 1. Publik & Pelanggan (`pelanggan`)
* **Landing Page & Company Profile:** Informasi usaha, filosofi dapur, lokasi outlet, jam operasional, dan kontak WhatsApp.
* **Katalog Menu Interaktif:** Daftar varian *Sweet Toast* (Manis) dan *Salted Toast* (Asin) lengkap dengan harga, deskripsi, stok, pencarian, filter kategori, dan modal detail menu.
* **Pemesanan Online & Catering:** Keranjang belanja *pick-up* / *delivery* serta formulir pemesanan jumlah besar (event/acara) dengan skema pembayaran **DP** maupun **Lunas** via **QRIS**.
* **Halaman Sponsorship:** Informasi syarat pengajuan kerja sama event dan tombol *redirect* langsung ke WhatsApp admin dengan pesan otomatis.

### 2. Kasir Outlet (`kasir`)
* **Point of Sale (POS) Offline:** Input transaksi langsung di tempat dengan dukungan metode pembayaran **Tunai** maupun **QRIS Kasir**.
* **Manajemen Pesanan Masuk:** Memantau pesanan online & catering serta memperbarui status pengerjaan (`Menunggu Konfirmasi` $\rightarrow$ `Diproses` $\rightarrow$ `Siap Diambil/Dikirim` $\rightarrow$ `Selesai`).

### 3. Pemilik Usaha (`owner`)
* **Dashboard & Rekapitulasi Keuangan:** Ringkasan statistik penjualan harian/bulanan serta perbandingan transaksi **Tunai vs QRIS**.
* **Export Laporan:** Unduh rekap transaksi lunas dalam format **Excel (`.xlsx`)** dan **PDF**.
* **Manajemen Produk & Akun Pengguna:** CRUD penuh untuk data menu toast dan manajemen hak akses akun (`owner`, `kasir`, `pelanggan`).

---

## 🗄️ Struktur Database (`db_toast_district`)

1. **`users`** — Menyimpan data akun pengguna (`nama`, `email`, `password`, `no_hp`, `alamat`, `role`: `owner` / `kasir` / `pelanggan`).
2. **`menus`** — Master data produk roti toast (`nama_menu`, `kategori`: `asin` / `manis`, `deskripsi`, `harga`, `stok`, `status_tersedia`, `gambar`).
3. **`orders`** — Pusat transaksi offline, online, dan catering terintegrasi Midtrans (`kode_pesanan`, `user_id`, `kasir_id`, `jenis_pesanan`, `metode_pengambilan`, `total_harga`, `jenis_pembayaran`, `snap_token`, `status_pembayaran`, `status_pesanan`).
4. **`order_details`** — Rincian item menu pada setiap transaksi pesanan.
5. **`business_profiles`** — Pengaturan profil usaha, jam operasional, link Google Maps, serta nomor & template pesan WhatsApp sponsorship.

---

## 👥 Tim Pengembang & Pembagian Tugas

| Anggota | Peran Utama | Tanggung Jawab Modul |
| :--- | :--- | :--- |
| **Ariel** | Lead Developer & Arsitektur Sistem | Setup proyek, struktur database, konfigurasi Midtrans & Laravel Fortify, Role Middleware, dan CRUD Manajemen User. |
| **Akira** | Frontend & Katalog Publik | Landing Page Company Profile, Katalog Menu (filter & pencarian), serta Halaman Info & Redirect Sponsorship. |
| **Dewi** | Master Produk & Kasir Offline (POS) | CRUD Data Produk Roti Toast dan modul Point of Sale (POS) transaksi harian di tempat. |
| **Caca** | Pemesanan Online, Catering & QRIS | Keranjang belanja, checkout online & catering, serta generate Snap Token / QRIS Midtrans. |
| **Naryama** | Webhook Payment & Operasional Pesanan | Callback/Webhook handler Midtrans otomatis dan manajemen alur status pesanan masuk. |
| **Abid** | Dashboard Owner & Pelaporan | Statistik penjualan Tunai vs QRIS, filter periode transaksi, dan Export Laporan ke Excel & PDF. |

---

## 🚀 Cara Menjalankan Proyek (Local Development)

1. **Clone repository ini:**
   ```bash
   git clone https://github.com/Ariel-F-S/Toast_District_PWL.git
   cd Toast_District_PWL
   ```

2. **Install dependency PHP & Frontend:**
   ```bash
   composer install
   npm install
   ```

3. **Salin file environment dan generate key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database & Midtrans di `.env`:**
   ```env
   DB_DATABASE=toast_district
   DB_USERNAME=root
   DB_PASSWORD=

   MIDTRANS_MERCHANT_ID=your_merchant_id
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_IS_PRODUCTION=false
   ```

5. **Jalankan Migrasi & Database Seeder:**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   *(Atau buka langsung melalui virtual host Laragon di `http://toast.test`)*

---

## 🔑 Akun Uji Coba (Default Seeder)

| Role | Email | Password |
| :--- | :--- | :--- |
| **Owner** | `owner@toastdistrict.com` | `password123` |
| **Kasir** | `kasir@toastdistrict.com` | `password123` |
| **Pelanggan** | `pelanggan@toastdistrict.com` | `password123` |

---

<p align="center">
  Dibuat dengan ❤️ oleh Kelompok PWL — D3 Manajemen Informatika Polinema PSDKU Kediri
</p>
