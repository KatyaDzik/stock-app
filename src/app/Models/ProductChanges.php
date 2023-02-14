<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChanges extends Model
{
    use HasFactory;

    protected $table = 'product_changes';

    public function editor()
    {
        return $this->belongsTo(User::class);
    }
}
