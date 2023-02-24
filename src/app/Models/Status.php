<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }
}
