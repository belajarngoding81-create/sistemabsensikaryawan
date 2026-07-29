<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen p-8">
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p class="mt-4">Your roles: {{ implode(', ', auth()->user()->roles->pluck('slug')->toArray()) }}</p>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
      @csrf
      <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded">Logout</button>
    </form>
  </div>
</body>
</html>
