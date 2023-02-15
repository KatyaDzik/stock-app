<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
