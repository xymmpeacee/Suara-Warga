# 📢 SuaraWarga (Layanan Pengaduan Masyarakat)

Sistem Informasi Pengaduan Warga berbasis Web yang dikembangkan menggunakan **Laravel 11** dan **Tailwind CSS**. Sistem ini memungkinkan warga untuk melaporkan masalah infrastruktur, fasilitas umum, dan lain-lain, yang kemudian dapat dikelola oleh Admin.

## 🚀 Fitur Utama

- **Warga (Publik):**
  - Membuat aduan/laporan dengan mudah (mendukung unggah foto bukti).
  - Melacak status aduan menggunakan `Tracking ID`.
  - Melihat aduan publik di halaman utama.
  - Memberikan **Upvote** pada aduan warga lain.
  - Notifikasi Email (Pembuatan aduan & Perubahan status oleh Admin).
  
- **Admin:**
  - Login khusus via `/admin/login`.
  - Dashboard interaktif untuk memonitor seluruh aduan.
  - Memverifikasi, memproses, atau menyelesaikan aduan (mengubah status).
  - Mengelola data secara *real-time*.

---

## 🛠 Panduan Instalasi (Untuk Tim Developer)

Jika kamu baru saja melakukan `git pull` dari repository ini, pastikan untuk menjalankan perintah-perintah berikut agar database dan konfigurasi di lokal komputer kamu tersinkronisasi dengan yang terbaru.

### 1. Perbarui Dependencies
Buka terminal di dalam folder project dan jalankan:
```bash
composer install
npm install
npm run build
```

### 2. Konfigurasi File Lingkungan (.env)
Pastikan kamu sudah memiliki file `.env` (bisa di-*copy* dari `.env.example`).
Atur bagian konfigurasi database kamu:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=suarawarga
DB_USERNAME=root
DB_PASSWORD=
```
*(Jangan lupa hidupkan MySQL via XAMPP atau Laragon).*

### 3. Migrasi & Seed Database (PENTING)
Berhubung kita sering merubah struktur tabel (terutama tabel `admins` dan `complaints`), **wajib** jalankan perintah ini supaya database lama kamu di-*reset* dan diisi dengan data dummy terbaru:
```bash
php artisan migrate:fresh --seed
```
⚠️ *Note: Perintah ini akan menghapus data lama di database lokal kamu dan menggantinya dengan struktur dan data yang baru.*

### 4. Link Storage
Agar foto atau file unggahan bisa tampil di web, jalankan:
```bash
php artisan storage:link
```

### 5. Jalankan Server
```bash
php artisan serve
```
Akses aplikasi melalui browser di `http://127.0.0.1:8000`.

---

## 🔐 Kredensial Admin Default

Setelah kamu menjalankan `migrate:fresh --seed` di atas, kamu dapat login ke **Admin Panel** di `http://127.0.0.1:8000/admin/login` menggunakan akses berikut:

- **Email:** `admin@suarawarga.id`
- **Password:** `password123`

---

## 📧 Testing Email (SMTP)
Sistem ini menggunakan pengiriman email untuk notifikasi ke warga. Pastikan `.env` kamu memiliki settingan SMTP yang benar jika ingin mencoba fitur notifikasi email secara penuh (misalnya pakai Mailtrap, atau Gmail App Password).

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=emailkamu@gmail.com
MAIL_PASSWORD=passwordapp_kamu
MAIL_ENCRYPTION=smtps
MAIL_FROM_ADDRESS=admin@suarawarga.id
MAIL_FROM_NAME="${APP_NAME}"
```

---
*Dibuat untuk keperluan Proyek UAS.*
