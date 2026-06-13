# ShareBite - Food Waste & Donation Platform

## 📌 Deskripsi Aplikasi

**ShareBite** adalah platform berbasis web yang dirancang untuk membantu mengurangi food waste (pemborosan makanan) dengan menghubungkan pihak yang memiliki makanan berlebih, seperti restoran, rumah makan, katering, hotel, maupun individu, dengan pihak yang membutuhkan.

Melalui ShareBite, donor dapat mengunggah informasi makanan yang masih layak konsumsi namun tidak terpakai, kemudian penerima dapat mengajukan klaim untuk memperoleh makanan tersebut. Sistem ini juga memungkinkan distribusi makanan ke panti asuhan, rumah singgah, dan komunitas sosial terdekat sehingga makanan yang masih layak konsumsi tidak terbuang sia-sia.

---

## 🎯 Tujuan Pengembangan

Aplikasi ShareBite dikembangkan dengan tujuan untuk:

* Mengurangi jumlah makanan yang terbuang (food waste).
* Mempermudah proses penyaluran makanan berlebih kepada pihak yang membutuhkan.
* Menjadi penghubung antara donor makanan dan penerima manfaat.
* Membantu organisasi sosial seperti panti asuhan memperoleh bantuan makanan secara lebih cepat.
* Menyediakan sistem pemantauan dan pelaporan distribusi makanan secara digital.

---

## 👥 Peran Pengguna

### 1. Donor

Pengguna yang mendonasikan makanan berlebih.

Fitur:

* Menambahkan data makanan.
* Mengelola donasi makanan.
* Melihat status klaim makanan.
* Memantau ketersediaan makanan.

### 2. Receiver

Pengguna yang menerima makanan donasi.

Fitur:

* Melihat daftar makanan yang tersedia.
* Mengajukan klaim makanan.
* Melihat riwayat klaim.
* Memantau status klaim.

### 3. Admin

Pengelola sistem.

Fitur:

* Mengelola pengguna.
* Memverifikasi dan memantau klaim.
* Melihat dashboard sistem.
* Mengakses laporan dan analitik.

---

## 🚀 Fitur Utama

### Authentication & Authorization

* Login
* Register
* Logout
* Role Management (Admin, Donor, Receiver)

### Food Management

* Tambah donasi makanan
* Edit data makanan
* Hapus data makanan
* Upload gambar makanan
* Pengelolaan stok makanan
* Informasi tanggal kedaluwarsa

### Claim Management

* Pengajuan klaim makanan
* Status klaim:
  * Pending
  * Accepted
  * Rejected
* Riwayat klaim
* Monitoring distribusi makanan

### Dashboard Admin

* Statistik pengguna
* Statistik donasi makanan
* Statistik klaim
* Monitoring aktivitas sistem

### Dashboard Analytics

* Ringkasan statistik sistem
* Total User
* Total Donasi
* Total Klaim Berhasil
* Total Klaim Pending
* Grafik Donasi dan Klaim per Bulan
* Top 5 Makanan yang Paling Banyak Diklaim
* Analisis Status Klaim
* Analisis Donasi Berdasarkan Lokasi
* Filter Laporan Berdasarkan Tahun

---

## 🛠️ Teknologi yang Digunakan

### Backend

* PHP 8.x
* Laravel 12

### Frontend

* Blade Template Engine
* Tailwind CSS
* JavaScript
* Chart.js

### Database

* SQLite / MySQL

### Authentication

* Laravel Breeze

### Development Tools

* Composer
* Node.js
* NPM
* Git & GitHub

---

## 🗄️ Struktur Database

### users

| Field      | Tipe                         |
| ---------- | ---------------------------- |
| id         | BIGINT                       |
| name       | VARCHAR                      |
| email      | VARCHAR                      |
| password   | VARCHAR                      |
| role       | ENUM(admin, donor, receiver) |
| created_at | TIMESTAMP                    |
| updated_at | TIMESTAMP                    |

---

### foods

| Field        | Tipe                  |
| ------------ | --------------------- |
| id           | BIGINT                |
| user_id      | BIGINT                |
| nama_makanan | VARCHAR               |
| deskripsi    | TEXT                  |
| jumlah       | INTEGER               |
| lokasi       | VARCHAR               |
| expired_at   | DATETIME              |
| gambar       | VARCHAR               |
| status       | ENUM(tersedia, habis) |
| created_at   | TIMESTAMP             |
| updated_at   | TIMESTAMP             |

---

### claims

| Field      | Tipe                              |
| ---------- | --------------------------------- |
| id         | BIGINT                            |
| food_id    | BIGINT                            |
| user_id    | BIGINT                            |
| jumlah     | INTEGER                           |
| status     | ENUM(pending, accepted, rejected) |
| created_at | TIMESTAMP                         |
| updated_at | TIMESTAMP                         |

---

## 🔗 Relasi Database

```text
User (Donor)
   │
   └───< Foods

Food
   │
   └───< Claims

User (Receiver)
   │
   └───< Claims
```

---

## 📥 Panduan Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd ShareBite
```

### 2. Install Dependency Backend

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

### 5. Konfigurasi Database

Atur konfigurasi database pada file `.env`

Contoh MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sharebite
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Jalankan Migration

```bash
php artisan migrate
```

---

### 7. Jalankan Seeder

```bash
php artisan db:seed
```

atau

```bash
php artisan migrate:fresh --seed
```

---

### 8. Build Asset Frontend

```bash
npm run build
```

atau saat development:

```bash
npm run dev
```

---

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

---

## 📸 Screenshot Tampilan Aplikasi

### Login Page

* Halaman autentikasi pengguna untuk masuk ke sistem.

### Dashboard Admin

* Menampilkan ringkasan statistik sistem.
* Monitoring aktivitas donasi dan klaim.

### Daftar Makanan

* Menampilkan daftar makanan yang tersedia untuk diklaim.

### Riwayat Klaim

* Menampilkan status klaim pengguna.

### Dashboard Analytics

* Grafik donasi dan klaim per bulan.
* Analisis status klaim.
* Top makanan yang paling banyak diklaim.
* Statistik donasi berdasarkan lokasi.

### Mockup Sistem ShareBite

---

## 🌱 Dampak Sosial

Dengan ShareBite, makanan yang masih layak konsumsi dapat disalurkan kepada masyarakat yang membutuhkan, mengurangi pemborosan makanan, serta mendukung terciptanya lingkungan yang lebih berkelanjutan dan peduli terhadap sesama.
