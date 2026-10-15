<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manifest extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'company_id',
        'created_by',
        'direction',
        'waste_name',
        'classification',
        'quantity',
        'unit',
        'status',
        'generated_at',
        'collected_at',
        'received_at',
        'final_disposal_at',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'generated_at' => 'datetime',
        'collected_at' => 'datetime',
        'received_at' => 'datetime',
        'final_disposal_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}