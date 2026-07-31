@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">
  <div class="w-full max-w-lg bg-white/95 backdrop-blur rounded-3xl shadow-xl border border-slate-200 p-10">
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-semibold text-slate-900">Masuk ke HRIS Absensi</h1>
      <p class="mt-2 text-slate-500">Akses cepat untuk karyawan, approver, dan admin.</p>
    </div>

    @if($errors->any())
      <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-700">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700">Password</label>
        <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
      </div>

      <div class="flex items-center justify-between gap-4">
        <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-3 text-white shadow hover:opacity-95">Login</button>
      </div>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-indigo-600">Daftar sekarang</a></p>
  </div>
</div>
@endsection
