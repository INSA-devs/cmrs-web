<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
    ];

    /**
     * Get all of the machinerySales for the Equipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function machinerySales(): HasMany
    {
        return $this->hasMany(MachinerySale::class);
    }

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
