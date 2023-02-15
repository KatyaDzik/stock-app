<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock',
        'address'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_stocks', 'stock_id', 'product_id');
    }
}
