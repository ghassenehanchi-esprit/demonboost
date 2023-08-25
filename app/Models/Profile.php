<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id', 'avatar', 'bio', 'is_seller', // Add other columns here
    ];

    /**
     * Get the user associated with the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function earnings()
{
    return $this->hasMany(Earning::class);
}

    // Define any additional methods or relationships here
}
