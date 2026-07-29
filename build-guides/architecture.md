# Arsitektur Sistem HRIS Absensi Karyawan

## 1. Konsep Arsitektur
Sistem dikembangkan dengan pendekatan modular monolith yang diadaptasi untuk ekosistem serverless. Struktur ini menyeimbangkan kemudahan pengembangan, skalabilitas, dan efisiensi biaya.

## 2. Layer Arsitektur
### Presentation Layer
- Antarmuka web responsif untuk desktop dan mobile.
- Fokus pada PWA agar dapat diakses dari browser tanpa instalasi.

### Application Layer
- Logika bisnis dikelola di Laravel.
- Modul dipisahkan berdasarkan domain seperti auth, attendance, approval, reporting, dan performance.

### Data Layer
- PostgreSQL sebagai sumber data utama.
- JSONB digunakan untuk data penilaian KPI/OKR yang fleksibel.
- Redis digunakan untuk cache, job queue, dan session jika diperlukan.

## 3. Komponen Utama
- Authentication & RBAC
- Modul absensi
- Modul pengajuan ketidakhadiran
- Modul approval workflow
- Modul KPI/OKR penilaian karyawan
- Dashboard eksekutif dan reporting
- Audit trail dan logging

## 4. Alur Request
1. User mengakses aplikasi melalui browser.
2. Laravel menerima request dan menerapkan middleware autentikasi.
3. Proses bisnis dijalankan sesuai modul yang dipanggil.
4. Data disimpan ke PostgreSQL melalui connection pooler Supabase.
5. Hasil ditampilkan kembali ke user dalam format responsif.

## 5. Deployment & Infrastruktur
- Aplikasi di-hosting di Vercel.
- Database di-manage oleh Supabase PostgreSQL.
- Supabase Connection Pooler (port 6543) wajib digunakan.
- File dokumen dan hasil export disimpan di Supabase Storage.
- Queue background dijalankan melalui Vercel Cron Jobs dan endpoint aman.

## 6. Pertimbangan Serverless
- Tidak boleh menyimpan file permanen di server lokal Vercel.
- Session dan cache sebaiknya menggunakan Redis.
- Validasi IP Wi-Fi kantor dilakukan melalui middleware trusted proxy.

## 7. Keamanan
- Role-based access control.
- Audit trail untuk setiap aksi penting.
- Enkripsi data sensitif dan validasi input.
- Penggunaan HTTPS dan proteksi terhadap request dari proxy.
