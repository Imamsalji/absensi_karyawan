# 📌 Aplikasi Absensi Karyawan Berbasis Laravel 10

Aplikasi absensi berbasis web untuk pencatatan kehadiran karyawan secara **Clock In / Clock Out**, dengan validasi **IP WiFi kantor**, serta laporan lengkap untuk HRD.

---

## 🚀 Teknologi yang Digunakan

- Laravel 10 imam
- Laravel Breeze Authentication (Blade)
- MySQL
- NodeJS + Vite
- Bootstrap 5

---

## ✨ Fitur Utama

| Fitur                | Keterangan                                         |
| -------------------- | -------------------------------------------------- |
| Clock In & Clock Out | Presensi online realtime berdasarkan IP kantor     |
| Validasi IP WiFi     | Absensi hanya bisa dilakukan jika IP sesuai kantor |
| Status Tepat / Telat | Menandai jika masuk lewat jam 07:00                |
| Clock Out 17:00      | Tidak bisa clockout sebelum jam 17:00              |
| Riwayat Absensi      | History untuk setiap karyawan                      |
| Laporan HRD          | Menampilkan semua data absensi                     |
| Filter tanggal       | Laporan bisa difilter berdasarkan tanggal          |
| Cetak laporan        | Print langsung via browser                         |
| Role Access          | Admin/HRD & Karyawan                               |

---

## 📦 Cara Clone & Install Aplikasi

### 1. Clone repository

```
git clone https://github.com/Imamsalji/absensi_karyawan.git
cd absensi_karyawan
```

### 2. Install composer dependency

```
composer install
```

### 3. Install npm dependency

```
npm install
```

### 4. Copy file .env

```
cp .env.example .env
```

Jika menggunakan PowerShell:

```
copy .env.example .env
```

### 5. Generate APP_KEY

```
php artisan key:generate
```

### 6. Setting database di file .env

```
DB_DATABASE=absensi
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migrasi database & seeder

```
php artisan migrate --seed
```

### 8. Jalankan vite assets

```
npm run dev
```

### 9. Jalankan server Laravel

```
php artisan serve
```

Akses di browser:

```
http://127.0.0.1:8000
```

---

## 🔑 Akun Default

```
Admin/HRD
email: admin@admin.com
password: password123

User
email: karyawan@gmail.com
password: password123
```

---

## 💡 Rencana Pengembangan

- Export PDF & Excel
- Rekap bulanan otomatis
- Lokasi GPS
- Integrasi Payroll

---

## 🤝 Kontribusi

Pull request dan saran sangat diterima.

---

## 📄 Lisensi

Project internal perusahaan dan untuk pengembangan lebih lanjut.

---

### ✨ Dibuat oleh

**Kelompok 1 Absensi Karyawan**
