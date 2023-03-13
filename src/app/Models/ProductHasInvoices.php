<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductHasInvoices
 * @package App\Models
 *
 * @property int $count
 * @property float $price
 * @property int $nds
 * @property int $product_id
 * @property int $invoice_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ProductHasInvoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'price',
        'nds',
        'product_id',
        'invoice_id'
    ];

    protected $table = 'product_has_invoices';

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
    public function invoice(): ?BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
