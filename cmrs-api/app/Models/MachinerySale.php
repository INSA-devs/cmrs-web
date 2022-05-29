<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MachinerySale extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'price',
        'status',
        'address',
        'equipment_id',
        'user_id'
    ];

    protected $casts = [
        'address' => 'object',
    ];

    /**
     * Get the equipment that owns the MachinerySale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get the user that owns the MachinerySale
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
