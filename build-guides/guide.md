# Panduan Project HRIS Absensi Karyawan

## 1. Tujuan Dokumen
Dokumen ini menjadi acuan awal untuk memahami arah pengembangan sistem HRIS dan absensi karyawan secara terstruktur, konsisten, dan siap dieksekusi oleh tim.

## 2. Fokus Utama Sistem
- Mengelola data karyawan dan struktur organisasi.
- Menyediakan proses absensi yang cepat dan aman.
- Menyediakan alur pengajuan cuti, izin, sakit, dan lembur.
- Menyediakan dashboard eksekutif dan laporan operasional.

## 3. Role Pengguna
- Superadmin: mengelola konfigurasi sistem, user, dan kebijakan global.
- HRD: mengelola data master, approval, dan laporan HR.
- Atasan/Manager: memantau tim, menyetujui pengajuan, dan melihat performa tim.
- Karyawan: mengakses absensi, pengajuan, dan profil pribadi.

## 4. Alur Bisnis Inti
1. Karyawan melakukan absensi melalui portal atau PWA.
2. Sistem memvalidasi koneksi dan identitas pengguna.
3. Pengajuan ketidakhadiran masuk ke alur approval bertingkat.
4. HRD dan atasan dapat memantau status pengajuan secara real-time.
5. Laporan otomatis diekspor dalam format Excel dan PDF.

## 5. Prinsip Pengembangan
- Mobile-first dan ringan untuk akses melalui browser HP.
- Kecepatan respons menjadi prioritas utama.
- Data sensitif harus aman dan terdokumentasi dengan audit trail.
- Gunakan pendekatan modular agar pengembangan lebih mudah dikelola.

## 6. Standar Implementasi
- Backend menggunakan Laravel v12.12.2 dengan arsitektur modular.
- Frontend dapat dibangun dengan Inertia + Vue 3 atau Livewire + Tailwind.
- Database utama PostgreSQL melalui Supabase.
- File dokumen dan laporan disimpan di Supabase Storage, bukan lokal server.

## 7. Checklist Pengembangan Awal
- [ ] Setup autentikasi dan RBAC
- [ ] Setup master data organisasi
- [ ] Implementasi modul absensi
- [ ] Implementasi approval workflow
- [ ] Implementasi dashboard dan laporan
- [ ] Setup audit log dan keamanan
