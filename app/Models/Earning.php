<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;
    protected $fillable = ['profile_id','amount', 'valorant_account_id','withdrawal_date','status'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function valorantAccountOrder()
    {
        return $this->belongsTo(ValorantAccountOrder::class);
    }
}
