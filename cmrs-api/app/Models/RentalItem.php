<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RentalItem extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'description',
        'price',
        'status'
    ];

    public function rentals(): HasOne
    {
        return $this->hasOne(Rentals::class);
    }
}
