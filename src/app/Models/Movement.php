<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Movement
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invoice|null $invoice
 * @property-read \App\Models\Status $status
 * @method static \Illuminate\Database\Eloquent\Builder|Movement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        return $this->belongsTo(Status::class);
    }
}
