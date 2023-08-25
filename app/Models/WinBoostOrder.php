<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinBoostOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', // unsignedBigInteger (foreign key)
        'total_price',
        'special_agent', //text nullable
        'p_with_booster', //boolean default false
        'is_priority', //boolean default false
        'current_rank',
        'wins_number',
        'server',
        'username',
        'password',
        'payment_status', //boolean default false
        'status', // text default in progress
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'username',
        'password'
        
    ];

    /**
     * Get the user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
