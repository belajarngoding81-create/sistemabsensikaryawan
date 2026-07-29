# AGENT.MD — AI Agent Execution Instructions

This file serves as the system instruction set for AI Agents (Cursor Agent, GitHub Copilot Workspace, Claude Code, Windsurf, etc.) working on the **HRIS Absensi Karyawan** project.

---

## 1. Project Overview & Context

- **Project Name:** HRIS Absensi Karyawan
- **Architecture:** Laravel 11 / 12 Modular Monolith (`app/Modules/`)
- **Primary Stack:** PHP 8.3+, Laravel, Tailwind CSS, Alpine.js / Livewire or Inertia.js
- **Database:** Supabase PostgreSQL via Supavisor Connection Pooler (`DB_PORT=6543`)
- **Cache & Queue:** Upstash Redis
- **Hosting / Infrastructure:** Vercel Serverless (`api/index.php` entrypoint)

---

## 2. Core Architecture Rules

### 2.1 Modular Monolith Structure
- **ALL domain logic MUST reside inside `app/Modules/{ModuleName}/`**.
- Do **NOT** create controllers, models, or services directly inside the default `app/Http/Controllers/` or `app/Models/` unless they are global utilities.
- Standard Module Anatomy:
  ```text
  app/Modules/{ModuleName}/
  ├── Controllers/
  ├── Models/
  ├── Services/
  ├── Repositories/
  ├── Providers/
  │   └── {ModuleName}ServiceProvider.php
  └── Routes/
      ├── web.php
      └── api.php
  ```

### 2.2 Autoloading & Registration
- Ensure all modules are registered under the `Modules\` namespace (`composer.json`).
- Any new module must have its Service Provider registered in `bootstrap/providers.php`.

---

## 3. Strict Coding Standards & Constraints

1. **Type Safety & Declaration:**
   - Always specify strict type hints for function arguments and return types.
   - Example: `public function clockIn(User $user, array $locationData): AttendanceRecord`

2. **Database & Environment:**
   - **NEVER** edit or overwrite `.env` files directly during automated runs.
   - For tests, always rely on `phpunit.xml` / `.env.testing` using SQLite `:memory:`.
   - Never hardcode database connection credentials or API keys.

3. **Code Formatting & Quality:**
   - Run Laravel Pint (`vendor/bin/pint`) before finishing any code generation.
   - Ensure zero static analysis errors using PHPStan / Larastan (`vendor/bin/phpstan analyse`).

4. **Vercel Serverless Awareness:**
   - Keep in mind that execution environments are stateless.
   - Use Upstash Redis for session state, rate limiting, and queues.
   - File uploads must go directly to Supabase Storage, **NEVER** local disk (`storage/app/public`).

---

## 4. Module Execution Roadmap (From `todo-list-guide.md`)

When asked to execute or implement tasks, follow the priority order below:

### Phase 1: Core & Auth (Sprint Week 1)
- [ ] Implement Auth scaffolding & RBAC (Roles: `admin`, `approver`, `karyawan`)
- [ ] Setup `User` model, migrations, and seeders inside `app/Modules/Auth/`

### Phase 2: Absensi (Sprint Week 1)
- [ ] Implement `Attendance` module (`app/Modules/Attendance/`)
- [ ] Create Clock-In / Clock-Out endpoints + UI
- [ ] Implement `CheckOfficeWifi` middleware for IP restriction
- [ ] Store geolocation and device info per clock-in entry

### Phase 3: Pengajuan & Approval Workflow (Sprint Week 2)
- [ ] Implement `LeaveRequest` module (`app/Modules/LeaveRequest/`)
- [ ] Multi-level approval workflow engine
- [ ] Email & in-app notification triggers

### Phase 4: Reporting & Exports (Sprint Week 2)
- [ ] Implement `Reporting` module (`app/Modules/Reporting/`)
- [ ] Async Excel / PDF report generation via queue jobs
- [ ] Setup Vercel Cron endpoints for background processing

---

## 5. Verification Checklist After Code Generation

Before declaring a task complete, verify that:
1. [ ] New code strictly follows the `app/Modules/{ModuleName}` structure.
2. [ ] All routes are properly registered in the module's `Routes/web.php` or `Routes/api.php`.
3. [ ] Database migrations are present, tested, and reversible.
4. [ ] `vendor/bin/pint` runs cleanly with no formatting violations.
5. [ ] Tests (Unit/Feature) exist and pass via `php artisan test`.