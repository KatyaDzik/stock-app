<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'date',
        'provider_id',
        'customer_id',
        'type_id',
        'from',
        'to',
        'status_id'
    ];

    /**
     * @return BelongsTo|null
     */
    public function provider(): ?BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    /**
     * @return BelongsTo|null
     */
    public function customer(): ?BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_has_invoices', 'invoice_id', 'product_id');
    }


    public function type(): ?BelongsTo
    {
        return $this->belongsTo(InvoiceType::class, 'type_id');
    }

    public function status(): ?BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
