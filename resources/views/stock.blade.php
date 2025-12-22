<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Management</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stock.css') }}">
</head>
<body>

<h1>📦 Stock Management</h1>

<div class="container">

    <!-- Add Stock Form -->
    <h3>Add New Stock</h3>
    <div class="form-group">
        <input type="text" placeholder="Product Name">
        <input type="text" placeholder="Category">
        <input type="number" placeholder="Quantity">
        <input type="number" placeholder="Price (RM)">
        <button>Add</button>
    </div>

    <!-- Stock Table -->
    <h3>Stock List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price (RM)</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->product_name }}</td>
                    <td>{{ $stock->category }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ number_format($stock->price, 2) }}</td>
                    <td class="
                        @if ($stock->quantity > 10) status-in
                        @elseif ($stock->quantity > 0) status-low
                        @else status-out
                        @endif
                    ">
                        @if ($stock->quantity > 10)
                            In Stock
                        @elseif ($stock->quantity > 0)
                            Low Stock
                        @else
                            Out of Stock
                        @endif
                    </td>
                    <td>
                        <button class="action-btn edit">Edit</button>
                        <button class="action-btn delete">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
