# Dokumen Konteks Sistem Informasi HR & Operasional

## 1. Ringkasan Proyek
Aplikasi ini adalah Sistem Informasi terintegrasi untuk mengelola sumber daya manusia (HRIS) dan kegiatan operasional perusahaan. Sistem dirancang dengan pendekatan mobile-first (Progressive Web App) agar mudah diakses oleh karyawan melalui browser HP tanpa perlu menginstal aplikasi dari Play Store / App Store. Fokus utama sistem adalah kecepatan, efisiensi bandwidth, keandalan data, serta transparansi pelaporan bagi eksekutif dan HRD.

## 2. Tech Stack & Infrastruktur
- **Pola Arsitektur**: Modular Monolith Serverless (Laravel di atas Serverless Functions Vercel).
 - **Backend Framework**: Laravel v12.12.2 (Optimized for Serverless Execution).
- **Frontend**: Laravel Inertia.js (Vue 3 / React) ATAU Laravel Livewire v3 + Tailwind CSS.
- **Hosting / Deployment**: **Vercel** (Global Edge CDN & Serverless Functions via `vercel-php`).
- **Database**: PostgreSQL (Fully-managed via **Supabase**).
- **Koneksi Database**: Supabase Connection Pooler (Port 6543 / Supavisor via Transaction Mode) - **Wajib** untuk mencegah error `Too Many Connections` akibat arsitektur Serverless Vercel.
- **Cache & Async Queue**: **Upstash Redis** (Serverless Redis REST API) untuk *caching* dan antrean *background jobs* (ekspor laporan & pemrosesan audit trail).
- **Aksesibilitas**: Progressive Web App (PWA) untuk antarmuka *mobile-friendly*.

## 3. Ruang Lingkup Modul & Fitur (Module Scope)

### A. Core & Authentication (RBAC)
- **Multi-Role Access**: Superadmin, HRD, Atasan/Manager, dan Karyawan.
- **Master Data**: Departemen, Jabatan, Jadwal Shift, dan Kalender Libur.
- **Audit Trail / Activity Log**: System-wide logging untuk merekam jejak digital setiap aksi penting (siapa, melakukan apa, kapan, dan perubahan data sebelum/sesudah) demi keamanan dan kepatuhan internal.

### B. Modul Absensi & Kehadiran (Time & Attendance)
- **Instant Clock-In / Clock-Out**: Proses absensi dilakukan dengan satu tombol, super cepat, tanpa foto selfie.
- **Validasi Jaringan (Wi-Fi Kantor)**: Absensi HANYA BISA dilakukan jika perangkat karyawan terhubung dengan jaringan internet / Wi-Fi kantor (Validasi IP Publik via `CheckOfficeWifi` Middleware).
- **Pengajuan Ketidakhadiran**:
  - Form pengajuan Cuti Tahunan, Izin, Sakit (dengan upload dokumen/surat dokter), dan Lembur.
  - Alur persetujuan (*Approval Workflow*) bertingkat dari Atasan hingga HRD.
- **Rekapitulasi Otomatis**: Perhitungan otomatis akumulasi jam kerja, keterlambatan (*tardiness*), pulang cepat (*early leave*), serta sisa jatah cuti karyawan secara real-time.
- **Server-Side Timestamp**: Pencatatan waktu masuk/keluar mutlak menggunakan waktu server PostgreSQL/Laravel.

### C. Modul Penilaian Karyawan (Performance Appraisal)
- Evaluasi kinerja berbasis KPI (Key Performance Indicator) atau OKR.
- **Skema Dinamis**: Menggunakan tipe data `JSONB` PostgreSQL untuk menyimpan indikator penilaian agar form dapat diubah setiap periode tanpa merusak struktur tabel.
- Alur persetujuan tingkat lanjut (Self-Assessment -> Evaluasi Atasan -> Finalisasi HRD).

### D. Modul Sistem Operasional
- **Task Management**: Pendelegasian tugas dari atasan ke bawahan.
- **Timesheet / Daily Activity**: Pencatatan riwayat pekerjaan harian karyawan.
- **Approval System**: Persetujuan pengajuan operasional dokumen atau alat.

### E. Modul Executive Dashboard & Reporting
- **Dashboard Eksekutif / HRD**:
  - Merekam ringkasan eksekutif secara real-time: persentase kehadiran hari ini, karyawan yang sedang cuti/sakit, status penyelesaian tugas operasional, dan rata-rata skor KPI perusahaan.
- **Ekspor Laporan (Excel & PDF)**:
  - Fitur ekspor laporan rekapitulasi absensi bulanan, rekap cuti, dan laporan evaluasi KPI ke dalam format **Excel (.xlsx)** dan **PDF**.
  - **Async Export Execution**: Ekspor laporan skala besar diproses via background queue (Laravel Queue + Redis) agar aplikasi tidak mengalami *HTTP Timeout* di Vercel.

## 4. Spesifikasi Desain UI & Layouting

- **Nama Tema UI**: **Soft Amber Executive** (Inspirasi: Soft UI Dashboard Pro / Neumorphism Light).
- **Karakter Visual**: Clean Light Mode, Floating Cards mengambang, Soft Blur Shadows, Vibrant Orange/Amber Gradient Accent.
- **Palette Warna Utama (Tailwind CSS)**:
  - Background Canvas: `#F8F9FA` (`bg-slate-100/60`)
  - Floating Cards & Sidebar: `#FFFFFF` dengan `shadow-[0_20px_27px_0_rgba(0,0,0,0.05)]` dan `rounded-2xl`
  - Active Accent / Primary Button: `bg-gradient-to-tl from-orange-600 to-amber-400`
  - Main Typography: Headings `#344767` (`text-slate-700`), Subtitle/Body `#67748E`
  - Status Badges: Emerald Green (`text-emerald-500`) untuk Hadir, Rose Red (`text-rose-500`) untuk Terlambat.
- **Layout Structure**:
  - **Desktop**: Floating Sidebar di kiri, Top Navigation dengan fitur pencarian & notifikasi, 4 Kartu Statistik Atas (dengan ikon berlatar belakang gradient orange di sudut kanan), Featured Action Card di kanan atas, serta Tabel Data Utama di bagian bawah.
  - **Mobile (PWA)**: Header terintegrasi dengan indikator status Wi-Fi kantor (Hijau = Terhubung Wi-Fi Kantor, Merah = Luar Jaringan), Main Action Card besar di layar utama untuk **Instant Clock-In**, dan Bottom Navigation Bar.

## 5. Catatan Arsitektur Vercel + Laravel (Serverless Adaptation)

1. **Ephemerality (Sifat Temporary File Storage)**:
   - Serverless di Vercel **tidak memiliki penyimpanan file permanen** (Read-Only File System, kecuali folder `/tmp`).
   - Semua dokumen pendukung (lampiran izin/sakit) serta hasil *generate* laporan Excel/PDF **TIDAK BOLEH** disimpan di lokal server Vercel (`storage/app`). Wajib dialihkan langsung ke **Supabase Storage**.
   - Session & Cache harus disimpan di **Redis (Upstash)**, bukan di *file session/cache* bawaan Laravel.

2. **Supabase Connection Pooling (Sangat Krusial)**:
   - Arsitektur Serverless Vercel akan *spawning* fungsi baru secara instan setiap ada *traffic* masuk.
   - Tanpa *Connection Pooler*, ratusan eksekusi fungsi Vercel secara bersamaan saat jam absen pagi akan menghabiskan kuota koneksi PostgreSQL Supabase dalam hitungan detik.
   - **Aturan**: Laravel WAJIB menggunakan `DB_PORT=6543` (Supavisor Transaction Mode).

3. **Background Queue / Workers**:
   - Vercel Serverless Function tidak bisa menjalankan *long-running process* seperti `php artisan queue:work` secara terus-menerus.
   - Eksekusi tugas terjadwal (Laravel Cron Scheduler / Queue) dijalankan menggunakan **Vercel Cron Jobs** yang memanggil *secured HTTP endpoint* pada Laravel secara berkala.

## 6. Penyesuaian Khusus Environment Vercel & Supabase

### A. Trusted Proxies untuk Validasi IP Wi-Fi (Vercel Reverse Proxy)
Di Laravel v12.12.2, atur `bootstrap/app.php` agar membaca IP pengunjung yang sebenarnya dari header Vercel:
```php
->withMiddleware(function (Middleware $middleware) {
    // Percayai proxy dari Vercel agar $request->ip() mendapatkan IP Publik Wi-Fi Pengguna$middleware->trustProxies(at: '*');
})