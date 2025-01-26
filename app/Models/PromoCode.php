<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'is_active',
        'expires_at',
        'valid_from',
        'valid_to',
        'max_activations',
        'activation_count',
    ];

    public function activations(): HasMany
    {
        return $this->hasMany(PromoCodeActivation::class);
    }
}
