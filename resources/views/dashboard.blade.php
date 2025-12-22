<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>
        <div class="mt-4">
            <a href="{{ route('inventory') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Go to Inventory</a>
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-4">Admin Dashboard</a>
            @endif
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </div>
</body>
</html>
