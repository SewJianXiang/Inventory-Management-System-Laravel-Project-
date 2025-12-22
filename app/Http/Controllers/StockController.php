<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Fake stock data for UI testing
        $stocks = [
            (object)[
                'id' => 1,
                'product_name' => 'Keyboard',
                'category' => 'Accessories',
                'quantity' => 25,
                'price' => 120.00
            ],
            (object)[
                'id' => 2,
                'product_name' => 'Mouse',
                'category' => 'Accessories',
                'quantity' => 5,
                'price' => 45.00
            ],
            (object)[
                'id' => 3,
                'product_name' => 'Monitor',
                'category' => 'Display',
                'quantity' => 0,
                'price' => 650.00
            ],
        ];

        return view('stock', compact('stocks'));

    }
}
