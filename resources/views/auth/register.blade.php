<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">Register</h1>

    @if($errors->any())
      <div class="mb-4 text-red-600">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <label class="block mb-2">Name
        <input type="text" name="name" value="{{ old('name') }}" class="w-full mt-1 p-2 border rounded" required>
      </label>
      <label class="block mb-2">Email
        <input type="email" name="email" value="{{ old('email') }}" class="w-full mt-1 p-2 border rounded" required>
      </label>
      <label class="block mb-4">Password
        <input type="password" name="password" class="w-full mt-1 p-2 border rounded" required>
      </label>
      <label class="block mb-4">Confirm Password
        <input type="password" name="password_confirmation" class="w-full mt-1 p-2 border rounded" required>
      </label>

      <div class="flex items-center justify-between">
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded">Register</button>
        <a href="{{ route('login') }}" class="text-sm text-indigo-600">Login</a>
      </div>
    </form>
  </div>
</body>
</html>
