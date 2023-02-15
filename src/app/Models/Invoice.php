<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'date'
    ];

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function movement()
    {
        return $this->hasOne(Movement::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_invoices', 'invoice_id', 'product_id');
    }
}
