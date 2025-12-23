<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Admin Inventory Management</h1>
        <p>Manage inventory items here, Admin {{ Auth::user()->name }}!</p>

        <div class="mt-6">
            <!-- Example inventory items with admin controls -->
            <div class="bg-white p-4 rounded shadow mb-4">
                <h2 class="text-xl font-semibold">Item 1</h2>
                <p>Description: Sample item</p>
                <p>Quantity: 10</p>
                <button class="bg-red-500 text-white px-4 py-2 rounded mt-2">Delete</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded mt-2 ml-2">Edit</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded mt-2 ml-2">Add Item</button>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back to Admin Dashboard</a>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
        </form>
    </div>
</body>
</html>
