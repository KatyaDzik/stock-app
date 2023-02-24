<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property int $provider_id
 * @property int $customer_id
 * @property int $movement_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'date'
    ];

    /**
     * @return BelongsTo|null
     */
    public function provider(): ?BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * @return BelongsTo|null
     */
    public function customer(): ?BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return Movement|null
     */
    public function movement(): ?BelongsTo
    {
        return $this->belongsTo(Movement::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_has_invoices', 'invoice_id', 'product_id');
    }
}
