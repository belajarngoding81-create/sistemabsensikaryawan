# TODO List & UI Skeleton — HRIS Absensi Karyawan

## Tujuan
Panduan ini berisi daftar tugas (TODO) untuk pelaksanaan proyek serta kerangka tampilan (wireframe) agar tim dapat memahami alur halaman dan prioritas pengerjaan.

---

## 1. Ringkasan Kerja
- Fokus: Implementasi HRIS Absensi berbasis Laravel v12.12.2 dengan PWA front-end.
- Durasi estimasi: Sprint awal 2 minggu (MVP)
- Output MVP: Autentikasi, Absensi (clock-in/out), Pengajuan, Approval, Dashboard dasar, Export laporan.

---

## 2. Kerangka Tampilan (UI Skeleton)
Tujuan bagian ini adalah memberi gambaran tiap halaman utama beserta komponen utamanya.

### 2.1 Global Layout
- Sidebar (left)
  - Logo + App Name
  - Navigasi: Dashboard, Absensi, Pengajuan, Approval, Karyawan, Laporan, Settings
- Topbar
  - Search
  - Notifikasi
  - Quick actions (Clock-in/Clock-out) shortcut
  - Avatar user + dropdown
- Main content area: Title + breadcrumbs + content cards / tables
- Floating Action Button (FAB) untuk aksi cepat di mobile

### 2.2 Halaman Dashboard
- Header: Ringkasan hari ini (karyawan hadir, cuti, terlambat)
- 4 statistik kartu: Hadir, Izin, Cuti, Sakit
- Grafik rekap kehadiran 30 hari terakhir
- Tabel aktivitas terbaru (pengajuan & approval)

### 2.3 Halaman Absensi
- Large primary action: Clock-In / Clock-Out button (visible state)
- Status koneksi (Wi-Fi kantor) indicator
- Riwayat absensi harian dengan pagination
- Lokasi/Device info pada tiap entri

### 2.4 Halaman Pengajuan
- Form singkat: jenis pengajuan, tanggal mulai, tanggal akhir, alasan, upload dokumen
- List pengajuan user beserta status

### 2.5 Halaman Approval
- Table pengajuan yang menunggu persetujuan
- Filter: level persetujuan, jenis pengajuan, tanggal
- Detail panel ketika klik row: detail pengajuan + Approve/Reject actions

### 2.6 Halaman Karyawan (Admin)
- Tabel master data karyawan
- Actions: tambah, edit, nonaktifkan

### 2.7 Halaman Laporan
- Export builder: Pilih jenis laporan, periode, format (Excel/PDF)
- Daftar export job (status pending/processing/done)

---

## 3. Daftar Tugas (Per Module)
Prioritas: High -> Medium -> Low

### A. Core & Auth (High)
- [ ] Setup Laravel v12.12.2 project skeleton
- [ ] Setup auth scaffolding (Laravel Breeze/Inertia atau Jetstream)
- [ ] RBAC: roles & permissions migration + seeders
- [ ] User model & factory

### B. Absensi (High)
- [ ] Attendance migrations & model
- [ ] Clock-in/out API endpoints + controller
- [ ] Middleware: CheckOfficeWifi
- [ ] Frontend Clock UI + offline friendly

### C. Pengajuan & Approval (High)
- [ ] Leave/Request migrations & models
- [ ] Approval workflow engine (multi-level)
- [ ] Notification (email/in-app)
- [ ] Frontend forms + list

### D. Reporting & Exports (Medium)
- [ ] Export jobs + queue integration
- [ ] Background worker endpoints for Vercel Cron
- [ ] Excel/PDF generator services

### E. Admin & Master Data (Medium)
- [ ] Departments, Positions migrations & CRUD
- [ ] User management UI

### F. Infrastructure & DevOps (High)
- [ ] Supabase connection pooling config (`DB_PORT=6543`)
- [ ] Redis (Upstash) config for sessions and queues
- [ ] Vercel deployment setup & cron jobs
- [ ] CI: tests & linting

### G. UI/UX polish (Low)
- [ ] Tailwind theme + components
- [ ] Accessibility checks
- [ ] PWA manifest & service worker

---

## 4. Prioritized Sprint Plan (2-week MVP)
Week 1
- Day 1-2: Project setup, auth, RBAC
- Day 3-5: Attendance backend & clock endpoint + basic frontend
- Day 6-7: Pengajuan backend (models/migrations)

Week 2
- Day 8-10: Approval flow + notifications
- Day 11-12: Reporting/Export (async)
- Day 13-14: Polish UI, PWA, and deployment config

---

## 5. Implementation Checklist
- [ ] Migrations created
- [ ] Seeder & factories
- [ ] Basic e2e flow: register -> clock-in -> pengajuan -> approve
- [ ] Deployment pipeline to Vercel configured
- [ ] Documentation updated in `build-guides`

---

## 6. Next Steps
- Pilih frontend stack: Inertia+Vue3 atau Livewire
- Saya dapat scaffold project awal (routes, auth, migrations) jika Anda ingin. Pilih opsi atau beri instruksi lanjutan.
