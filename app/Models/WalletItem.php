<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletItem extends Model
{
    protected $fillable = [
        'wallet_id', 'name', 'balance', 'manage'
    ];

    public function Wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }
}
