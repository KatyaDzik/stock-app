<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'author_id'
    ];

    /**
     * @return BelongsTo|nullmake:request
     */
    public function category(): ?BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo|null
     */
    public function author(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Stock::class, 'product_has_stocks', 'product_id', 'stock_id');
    }

    /**
     * @return BelongsToMany
     */
    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'product_has_invoices', 'product_id', 'invoice_id');
    }
}
