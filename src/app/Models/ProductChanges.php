<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductChanges
 *
 * @property string $product
 * @property int $product_id
 * @property int $editor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $editor
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductChanges whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductChanges extends Model
{
    use HasFactory;

    protected $table = 'product_changes';

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
