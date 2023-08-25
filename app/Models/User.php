<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'verified',
        'provider',
        'is_admin',
        'is_banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified' => 'boolean',
    ];

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the accounts associated with the user.
     */
    public function smurfAccountOrders()
    {
        return $this->hasMany(SmurfAccountOrder::class);
    }
    public function valorantAccounts()
    {
        return $this->hasMany(ValorantAccount::class);
    }
    public function verifications()
    {
        return $this->hasMany(Verification::class);
    }

    /**
     * Get the boosts associated with the user.
     */
    public function rankBoostOrders()
    {
        return $this->hasMany(RankBoostOrder::class);
    }
    public function PlacementBoostOrders()
    {
        return $this->hasMany(PlacementBoostOrder::class);
    }
    public function WinBoostOrders()
    {
        return $this->hasMany(WinBoostOrder::class);
    }
    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->is_admin === true;
    }
    public function routeNotificationForDiscord()
    {
        return $this->discord_private_channel_id;
    }
}
