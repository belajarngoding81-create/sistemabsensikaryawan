# Layout Guide HRIS Absensi Karyawan

## 1. Struktur Layout Desktop
Layout desktop menggunakan pendekatan dashboard modern dengan elemen floating card.

### Area Utama
- Sidebar kiri untuk navigasi utama
- Topbar atas untuk pencarian, notifikasi, dan profil pengguna
- Area konten utama berisi ringkasan statistik dan aksi cepat
- Bagian bawah menampilkan tabel data atau daftar aktivitas

### Susunan Visual
1. Kartu statistik di bagian atas
2. Featured action card di sisi kanan atas
3. Tabel data utama di bagian bawah
4. Elemen support seperti filter, tombol ekspor, dan status

## 2. Struktur Layout Mobile
Layout mobile dibuat khusus untuk pengalaman PWA yang cepat dan ringan.

### Elemen Utama
- Header dengan status koneksi Wi-Fi kantor
- Card aksi besar untuk tombol absensi
- Bottom navigation untuk akses cepat ke menu utama
- Form ringkas untuk pengajuan dan approval

## 3. Layout Per Modul
### Dashboard
- Ringkasan kehadiran hari ini
- Status cuti/sakit aktif
- Tugas operasional yang belum selesai
- Ringkasan KPI atau performa

### Absensi
- Tombol clock-in/clock-out besar
- Informasi status koneksi dan jam kerja
- Riwayat absensi harian atau bulanan

### Pengajuan
- Form singkat dengan pilihan jenis pengajuan
- Area upload dokumen pendukung
- Status approval secara real-time

### Approval
- Daftar pengajuan yang menunggu persetujuan
- Detail pengajuan dalam panel terpisah
- Tombol approve/reject yang jelas

### Laporan
- Filter periode dan jenis laporan
- Tombol export Excel/PDF
- Tabel hasil dengan opsi ekspor dan pencarian

## 4. Spacing dan Grid
- Gunakan grid 12 kolom untuk desktop.
- Gunakan spacing konsisten seperti 8, 12, 16, 24, dan 32 px.
- Card diberi radius 16-24 px agar terlihat modern.
- Jarak antar elemen dibuat cukup lega agar tidak terasa padat.

## 5. Catatan Implementasi UI
- Prioritaskan elemen penting di bagian atas layar.
- Hindari overload informasi pada layar kecil.
- Semua tombol aksi utama wajib terlihat jelas dan mudah disentuh.
