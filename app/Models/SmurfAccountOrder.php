<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmurfAccountOrder extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'smurf_account_type',
        'price',
        'smurf_account_token',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
