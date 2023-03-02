<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductHasStocks
 * @package App\Models
 */
class ProductHasStocks extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'price',
        'nds',
        'product_id',
        'stock_id'
    ];

    protected $table = 'product_has_stocks';

    /**
     * @return null|BelongsTo
     */
    public function product(): ?BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return null|BelongsTo
     */
    public function stock(): ?BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
