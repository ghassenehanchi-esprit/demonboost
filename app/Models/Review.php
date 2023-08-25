<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', // string
        'rating', // integer
        'profile_id', // unsignedBigInteger (foreign key) - User who wrote the review
        'reviewed_profile_id', // unsignedBigInteger (foreign key) - User who is being reviewed
    ];

    /**
     * Get the user who wrote the review.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }

    /**
     * Get the user who is being reviewed.
     */
    public function reviewedprofile()
    {
        return $this->belongsTo(Profile::class, 'reviewed_user_id');
    }
}
