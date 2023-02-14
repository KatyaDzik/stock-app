<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
