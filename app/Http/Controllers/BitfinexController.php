<?php

namespace App\Http\Controllers;

use App\Services\Bitfinex;
use Binance\API;
use ccxt;
use ccxt\Exchange;
use Illuminate\Support\Facades\DB;

class BitfinexController extends Controller
{

    public function show()
    {


//        $api = new \Binance\API();  //
//        $exchangeInfo = $api->exchangeInfo();
//        dd($exchangeInfo);
//        die();

        $obj = new ccxt\poloniex(); //bitfinex,wex,kraken,exmo,bithumb,poloniex
//        $obj = new ccxt\bittrex(); //bitfinex,wex,kraken,exmo,bithumb,poloniex


//        $results = $obj->fetch_tickers();
//        $results = $obj->fetch_ticker('BTC/USD');
//        $results = $obj->fetch_ticker('ETH/USDT');
//        $results = $obj->fetch_ticker('BTC/ETH');
        $results = $obj->fetch_ticker('ETH/USDT');

        dd($results);

    }

}
