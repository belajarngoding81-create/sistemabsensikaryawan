@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">
  <div class="w-full max-w-lg bg-white/95 backdrop-blur rounded-3xl shadow-xl border border-slate-200 p-10">
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-semibold text-slate-900">Buat akun HRIS Absensi</h1>
      <p class="mt-2 text-slate-500">Daftar sebagai karyawan untuk mulai menggunakan sistem absensi.</p>
    </div>

    @if($errors->any())
      <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-700">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-slate-700">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700">Password</label>
        <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700">Confirm Password</label>
        <input type="password" name="password_confirmation" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" required>
      </div>

      <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-500 px-6 py-3 text-white shadow hover:opacity-95">Register</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-indigo-600">Masuk</a></p>
  </div>
</div>
@endsection
