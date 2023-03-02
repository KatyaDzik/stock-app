<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ReceiptOfProducts
 * @package App\Models
 */
class ReceiptOfProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'price',
        'nds',
        'product_id',
    ];

    protected $table = 'product_has_invoices';

    /**
     * @return null|BelongsTo
     */
    public function product(): ?BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
