<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id', 'name', 'symbol', 'available_balance', 'price', 'chance', 'pending', 'value'
    ];
    public function items(){
        return $this->hasMany(WalletItem::class,'wallet_id', 'id');
    }
}
