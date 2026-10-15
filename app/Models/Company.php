<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rfc',
        'type',
        'email',
        'phone',
        'address',
        'semarnat_authorization',
        'status',
    ];

    public function manifests(): HasMany
    {
        return $this->hasMany(Manifest::class);
    }
}
