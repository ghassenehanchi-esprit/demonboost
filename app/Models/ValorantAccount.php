<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorantAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'server',
        'rank',
        'level',
        'level_method',
        'number_of_skins',
        'description',
        'price',
        'username',
        'password',
        'email',
        'email_password',
        'full_access',
        'is_sold',
        'user_id',
        'account_rank_image',
    ];

    protected $hidden = [
        'password',
        'email_password',
    ];

    protected $casts = [
        'full_access' => 'boolean',
        'is_sold' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function valorantAccountOrder()
    {
        return $this->hasOne(ValorantAccountOrder::class);
    }
    
}
