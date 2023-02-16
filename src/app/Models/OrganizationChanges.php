<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrganizationChanges
 *
 * @property int $id
 * @property string $name
 * @property int $organization_id
 * @property int $editor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $editor
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrganizationChanges whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrganizationChanges extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $table = 'organization_changes';

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id', 'id');
    }
}
