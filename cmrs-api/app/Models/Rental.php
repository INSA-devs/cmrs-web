<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Rental extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable= [
        'name',
        'description',
        'phone',
        'price',
        'status',
        'address',
        '_geo',
        'equipment_id',
        'user_id',
        'pricing_type_id'
    ];

    protected $casts = [
        'address' => 'object',
        '_geo' => 'object',
    ];

    /**
     * Get the equipment that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the pricingTypes that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function pricingTypes(): BelongsTo
    {
        return $this->belongsTo(PricingType::class);
    }

    /**
     * Get the user that owns the Rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImagesAttribute()
    {
        $urls = [];

        foreach ($this->getMedia('images') as $key => $image) {
            $urls[] = $image->getFullUrl();
        }

        return !empty($urls) ? $urls : [$this->getFirstMediaUrl('images')];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->useFallbackUrl(url('/images/defaults/default.png'))
            ->useFallbackPath(public_path('/images/defaults/default.png'));
    }

}
