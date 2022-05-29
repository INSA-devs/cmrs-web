<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingType extends Model
{
    use HasFactory;

    protected $fillable= [
        'label',
    ];

    /**
     * Get all of the rentals for the Equipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
