<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrganizationChanges
 *
 * @property int $id
 * @property string $name
 * @property int $organization_id
 * @property int $editor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class OrganizationChanges extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $table = 'organization_changes';

    /**
     * @return BelongsTo|null
     */
    public function editor(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
