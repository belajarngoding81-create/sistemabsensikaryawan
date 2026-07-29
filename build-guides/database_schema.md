# Skema Database HRIS Absensi Karyawan

## 1. Pendekatan Database
Database utama menggunakan PostgreSQL dengan beberapa tabel inti untuk operasi HR, absensi, approval, penilaian, dan audit. Struktur dibuat agar mudah dikembangkan dan mendukung data semi-terstruktur melalui JSONB.

## 2. Tabel Utama
### users
- id (PK)
- name
- email
- password_hash
- department_id (FK)
- position_id (FK)
- role_id (FK)
- is_active
- created_at
- updated_at

### roles
- id (PK)
- name
- slug
- description

### permissions
- id (PK)
- name
- slug

### departments
- id (PK)
- name
- code
- parent_department_id
- is_active

### positions
- id (PK)
- name
- level
- department_id

### schedules
- id (PK)
- department_id
- name
- start_time
- end_time
- working_days

### holidays
- id (PK)
- date
- name
- type
- is_recurring

### attendance_records
- id (PK)
- user_id (FK)
- clock_in_at
- clock_out_at
- work_date
- status
- source
- location_ip
- notes

### leave_requests
- id (PK)
- user_id (FK)
- request_type
- start_date
- end_date
- reason
- attachment_path
- status
- approved_by
- approved_at

### overtime_requests
- id (PK)
- user_id (FK)
- request_date
- start_time
- end_time
- reason
- status

### approvals
- id (PK)
- request_type
- request_id
- current_level
- status
- approver_id
- approved_at
- note

### performance_periods
- id (PK)
- name
- start_date
- end_date
- status

### performance_reviews
- id (PK)
- user_id (FK)
- period_id (FK)
- self_assessment
- supervisor_review
- final_score
- status

### tasks
- id (PK)
- title
- description
- assigned_to
- assigned_by
- due_date
- status

### timesheet_entries
- id (PK)
- user_id (FK)
- task_id (FK)
- work_date
- duration_hours
- notes

### audit_logs
- id (PK)
- user_id
- action
- module
- entity_type
- entity_id
- payload_before
- payload_after
- created_at

### documents
- id (PK)
- owner_id
- document_type
- storage_path
- file_name
- uploaded_at

## 3. Hubungan Inti
- users ke departments dan positions
- users ke attendance_records, leave_requests, overtime_requests, performance_reviews
- approvals terkait dengan berbagai jenis request
- tasks dan timesheet_entries mendukung modul operasional
- audit_logs mencatat perubahan penting di seluruh sistem

## 4. Catatan Implementasi
- Gunakan tipe data JSONB untuk bagian penilaian KPI/OKR agar skema lebih fleksibel.
- Sertakan indeks pada kolom user_id, status, work_date, dan request_type.
- Simpan dokumen pendukung di Supabase Storage dan simpan path-nya di database.
