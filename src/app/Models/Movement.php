<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to'
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
