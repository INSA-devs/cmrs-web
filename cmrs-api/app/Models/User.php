<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Contracts\HasApiTokens as HasApiTokensContract;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements HasApiTokensContract
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get all of the machinerySales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function machinerySales(): HasMany
    {
        return $this->hasMany(MachinerySale::class);
    }

    /**
     * Get all of the rentals for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
