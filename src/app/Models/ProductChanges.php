<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductChanges
 *
 * @property string $product
 * @property int $product_id
 * @property int $editor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ProductChanges extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'product_id',
        'editor_id'
    ];

    protected $table = 'product_changes';


    /**
     * @return BelongsTo|null
     */
    public function editor(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
