<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Movement
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to'
    ];

    /**
     * @return HasOne|null
     */
    public function invoice(): ?HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * @return BelongsTo|null
     */
    public function status(): ?BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
