<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $table = 'product_histories';

    protected $fillable = [
        'product_id',
        'user_id',
        'user_name',
        'action',
        'previous_values',
        'new_values',
    ];

    protected $casts = [
        'previous_values' => 'array',
        'new_values' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
