<?php

namespace App\Listeners;

use App\Events\ConfirmPhone;
use App\Models\Wallet;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultWallets
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ConfirmPhone $event
     * @return void
     */
    public function handle(ConfirmPhone $event)
    {
        $wallet = Wallet::create([
            'user_id' => $event->user->id,
            'name' => 'bitcoin',
            'symbol' => 'BTC',
            'available_balance' => 0,
            'price' => 0,
            'chance' => 0,
            'pending' => 0,
            'value' => 0,
        ]);
        if ($wallet) {
            $wallet = Wallet::create([
                'user_id' => $event->user->id,
                'name' => 'bitcoin_cache',
                'symbol' => 'BCH',
                'available_balance' => 0,
                'price' => 0,
                'chance' => 0,
                'pending' => 0,
                'value' => 0,
            ]);
            if ($wallet) {
                $wallet = Wallet::create([
                    'user_id' => $event->user->id,
                    'name' => 'ethereum',
                    'symbol' => 'ETH',
                    'available_balance' => 0,
                    'price' => 0,
                    'chance' => 0,
                    'pending' => 0,
                    'value' => 0,
                ]);
                if ($wallet) return true;
            }
        }
        return false;
    }
}
