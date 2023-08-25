<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['valorant_account_order_id', 'reason', 'attachment'];

    public function valorantAccountOrder()
    {
        return $this->belongsTo(ValorantAccountOrder::class);
    }
}
