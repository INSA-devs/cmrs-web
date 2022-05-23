<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rental_item_id',
    ];

    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function rentalItems(): BelongsTo
    {
        return $this->belongsTo(RentalItem::class);
    }
}

