<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function stock()
    {
        return $this->belongsToMany(Stock::class, 'product_has_stocks', 'product_id', 'stock_id');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'product_has_invoices', 'product_id', 'invoice_id');
    }

}
