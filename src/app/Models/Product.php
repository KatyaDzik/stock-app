<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function stock()
    {
        return $this->belongsToMany(Stock::class, 'product_has_stocks', 'product_id', 'stock_id');
    }

    public function invoice()
    {
        return $this->belongsToMany(Invoice::class, 'product_has_invoices', 'product_id', 'invoice_id');
    }

}
