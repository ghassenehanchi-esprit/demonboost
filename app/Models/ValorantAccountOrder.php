<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorantAccountOrder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'valorant_account_id', 'account_token', 'discord_username','payment_token','payment_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function valorantAccount()
    {
        return $this->belongsTo(ValorantAccount::class);
    }
    public function earning()
{
    return $this->hasOne(Earning::class);
}
protected static function boot()
{
    parent::boot();

    // Cascade delete related reports
    static::deleting(function ($valorantAccountOrder) {
        $valorantAccountOrder->reports()->delete();
    });
}
}
