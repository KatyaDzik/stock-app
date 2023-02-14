<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationChanges extends Model
{
    use HasFactory;

    protected $table = 'organization_changes';

    public function editor()
    {
        return $this->belongsTo(User::class);
    }
}
