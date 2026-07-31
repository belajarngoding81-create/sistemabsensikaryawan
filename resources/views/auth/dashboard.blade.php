@extends('layouts.auth')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 px-4">
  <div class="mx-auto max-w-5xl space-y-8">
    <header class="rounded-3xl border border-slate-200 bg-white/95 p-8 shadow-sm backdrop-blur">
      <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
          <p class="text-sm uppercase tracking-[0.2em] text-slate-400">Welcome back</p>
          <h1 class="mt-3 text-4xl font-semibold text-slate-900">Hi, {{ auth()->user()->name }}</h1>
          <p class="mt-2 text-slate-500">Ini dashboard singkat untuk melihat akses role dan navigasi awal.</p>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
          @csrf
          <button type="submit" class="rounded-2xl bg-rose-600 px-5 py-3 text-white transition hover:bg-rose-500">Logout</button>
        </form>
      </div>
    </header>

    <section class="grid gap-6 md:grid-cols-3">
      <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Email</p>
        <p class="mt-3 text-xl font-semibold text-slate-900">{{ auth()->user()->email }}</p>
      </article>
      <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Roles</p>
        <p class="mt-3 text-xl font-semibold text-slate-900">{{ implode(', ', auth()->user()->roles->pluck('slug')->toArray()) }}</p>
      </article>
      <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Akses</p>
        <p class="mt-3 text-xl font-semibold text-slate-900">{{ auth()->user()->roles->isNotEmpty() ? 'Role-based' : 'Belum terdaftar' }}</p>
      </article>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
      <h2 class="text-xl font-semibold text-slate-900">Navigation</h2>
      <p class="mt-2 text-slate-500">Halaman berikut bisa dikembangkan untuk modul Absensi, Pengajuan, dan Approval.</p>
      <div class="mt-6 grid gap-4 sm:grid-cols-2">
        <a href="/dashboard" class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm font-medium text-slate-700 transition hover:bg-slate-100">Dashboard Overview</a>
        <a href="/dashboard/admin" class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm font-medium text-slate-700 transition hover:bg-slate-100">Admin Area</a>
      </div>
    </section>
  </div>
</div>
@endsection
