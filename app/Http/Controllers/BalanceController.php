<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class BalanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ccxt = new \ccxt\poloniex();
        $tickers = $ccxt->fetch_tickers();
        return view('balance.index', compact('user', 'tickers'));
    }

    public function add_wallet(Request $request)
    {
        $request['id'] = $request->id;
        $validator = Validator::make($request->all(), [
            'name_wallet' => 'required|string',
            'id' => 'required|exists:wallets,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $item = WalletItem::create([
            'wallet_id' => $request->id,
            'name' => $request->name_wallet,
            'balance' => 0,
            'manage' => 'manage',
        ]);
        $wallet = $item->wallet;
        greturn View::make('balance.wallet-items', compact('wallet'));


    }
}
