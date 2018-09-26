@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="currency_info">
            <div class="wrapper">
                <div class="currency_wrap">
                    <div class="currency">
                        <div class="currency_name">BCH/BTC</div>
                        <div class="currency_count">{{$tickers['BCH/BTC']['info']['last']}}</div>
                        @php($change = (float) $tickers['BCH/BTC']['info']['percentChange'])
                        <div
                            class="currency_dinamic {{$change < 0 ? 'low': 'grow' }} ">{{number_format($change,3, '.', '')}}</div>
                    </div>
                    <div class="currency">
                        <div class="currency_name">ETH/BTC</div>
                        <div class="currency_count">{{$tickers['ETH/BTC']['info']['last']}}</div>
                        @php($change = (float) $tickers['ETH/BTC']['info']['percentChange'])
                        <div
                            class="currency_dinamic {{$change < 0 ? 'low': 'grow' }} ">{{number_format($change,3, '.', '')}}</div>
                    </div>

                    <div class="currency">
                        <div class="currency_name">BTC/USDT</div>
                        <div class="currency_count">{{$tickers['BTC/USDT']['info']['last']}}</div>
                        @php($change = (float) $tickers['BTC/USDT']['info']['percentChange'])
                        <div
                            class="currency_dinamic {{$change < 0 ? 'low': 'grow' }} ">{{number_format($change,3, '.', '')}}</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="exchange-tab">
            <div class="wrapper">
                <div class="tabs">
                    <div class="personal_service col-r">
                        <div class="personal_balance"><span>Total Balance</span>
                            <div data-balance="RUB" class="current_balance"><strong>RUB </strong><a href="#"
                                                                                                    class="balance_count">
                                    0.00</a>
                            </div>
                            <ul hidden class="personal_balance_menu">
                                <li data-balance="RUB"><strong>RUB </strong><a href="#" class="balance_count"> 0.00</a>
                                </li>
                                <li data-balance="USD"><strong>USD </strong><a href="#" class="balance_count"> 0.00</a>
                                </li>
                                <li data-balance="EUR"><strong>EUR </strong><a href="#" class="balance_count"> 0.00</a>
                                </li>
                                <li data-balance="BTC"><strong>BTC </strong><a href="#" class="balance_count"> 0.00</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="tabs_menu clearfix">
                        <li class="active">Balance</li>
                        <li>Sent</li>
                        <li>Request</li>
                        <li>Exchange</li>
                    </ul>
                    <div class="clear"></div>
                    <div class="tabs_content">
                        <div id="content1" class="section active">
                            <div class="wallets">
                                <table class="balance-personal">
                                    <thead>
                                    <tr>
                                        <th>CURRENCY NAME</th>
                                        <th>SYMBOL</th>
                                        <th>AVAILABLE BALANCE</th>
                                        <th>PRICE</th>
                                        <th><span class="changelog">CHANGE %</span>
                                        </th>
                                        <th>PENDING</th>
                                        <th>VALUE <span>USD</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="wallets_menu">
                                    @foreach($user->wallets as $wallet)
                                        @php(${mb_strtolower($wallet->symbol)} = $tickers[$wallet->symbol.'/USDT']['info'])
                                        @php($change = (float) ${mb_strtolower($wallet->symbol)}['percentChange'])
                                        <tr>
                                            <td>
                                                <a href="#" id="{{$wallet->name}}"
                                                   class="availableCurrency wallet">{{$wallet->name}}</a>
                                            </td>
                                            <td>
                                                <span class="availableCurrencySymbol">{{$wallet->symbol}}</span>
                                            </td>
                                            <td>
                                                <span class="availableBalanceCoin">{{$wallet->available_balance}}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="course">{{${mb_strtolower($wallet->symbol)}['last']}}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="changelog-percent {{$change < 0 ? 'less': 'grow' }} ">{{number_format($change,3, '.', '')}}</span>
                                            </td>
                                            <td><span class="pending">{{$wallet->pending}}</span>
                                            </td>
                                            <td><span class="availableBalance">{{$wallet->value}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="wallets_content">
                                    @foreach($user->wallets as $wallet)
                                        <div data-wallet="{{$wallet->name}}" class="content_inner">
                                            <div class="wallets_head clearfix">
                                                <div class="col-r search">
                                                    <form>
                                                        <input name="search_wallets" type="search" placeholder="SEARCH">
                                                        <button type="submit" class="search-btn"></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="wallets_body">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('generic.your_balance')</th>
                                                        <th><span
                                                                class="summCrypt">{{$wallet->items->sum('balance')}} {{$wallet->symbol}}</span>
                                                        </th>
                                                        <th>
                                                            <span class="summDollar">
                                                                {{$wallet->items->sum('balance') * ${mb_strtolower($wallet->symbol)}['last']}}
                                                                $
                                                            </span>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody data-tbody="{{$wallet->id}}">

                                                    @include('balance.wallet-items')

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <a href="#addWallet{{$wallet->symbol}}"
                                                               class="fancybox">@lang('generic.add_wallet')</a>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="transitions">
                                <div class="transitions_selection clearfix"><span>Transaction History</span>
                                    <div class="col-r"><span class="transitions-currency">Currency:</span>
                                        <select>
                                            <option>Bitcoin</option>
                                            <option disabled class="inactive">Ripple</option>
                                            <option>Litecoin</option>
                                            <option disabled class="inactive">Dogecoin</option>
                                            <option>Dash</option>
                                            <option>Ethereum</option>
                                            <option>Peercoin</option>
                                        </select>
                                    </div>
                                    <div class="col-r"><span class="transitions-type">Type</span>
                                        <select>
                                            <option>Received</option>
                                            <option>Sent</option>
                                        </select>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Received BTC</td>
                                        <td>Sep 20, 2017</td>
                                        <td>0.0508953 BTC</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="more"><a href="#" id="moreTransitions">Show more</a></p>
                            </div>
                        </div>
                        <div id="content2" class="section">
                            <div class="sent-form">
                                <form action="/" method="post" name="sent-form">
                                    <div class="form-head"><span class="exchange-currency">Currency:</span>
                                        <select>
                                            <option>Bitcoin</option>
                                            <option disabled class="inactive">Ripple</option>
                                            <option>Litecoin</option>
                                            <option disabled class="inactive">Dogecoin</option>
                                            <option>Dash</option>
                                            <option>Ethereum</option>
                                            <option>Peercoin</option>
                                        </select>
                                    </div>
                                    <div class="form-body">
                                        <label for="#fromExchange">
                                            <p>From</p>
                                        </label>
                                        <input type="text" placeholder="Эйфелева башня" name="fromExchange" required
                                               id="from_Exchange">
                                        <label for="#toExchange" class="clearfix">
                                            <p>To</p>
                                            <div id="selectCode" class="col-r dropdown-select">
                                                <div class="dropdown-toggle">
                                                    <img src="static/img/content/qr-code.png">
                                                </div>
                                                <ul hidden class="dropdown-menu">
                                                    <li value="qr-code">
                                                        <img src="static/img/content/qr-code.png">
                                                    </li>
                                                    <li value="qr-code">
                                                        <img src="static/img/content/qr-code.png">
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="text"
                                                   placeholder="Paste or scan an Adress or select a destination "
                                                   name="toExchange" required id="to_Exchange">
                                        </label>
                                        <p>Enter Amount:</p>
                                        <div class="clearfix row amount">
                                            <label class="col-xs-5">
                                                <input type="number" placeholder="0.1000000" name="Amount" required
                                                       id="amount_from_input"><span
                                                    id="change-currency-from-btn">BTC</span>
                                            </label>
                                            <div class="col-xs-2">
                                                <a href="#" class="swap-fields"></a>
                                            </div>
                                            <label class="col-xs-5">
                                                <input type="number" placeholder="570" name="Amount" required
                                                       id="amount_to_input"><span id="change-currency-to-btn">USD</span>
                                            </label>
                                        </div>
                                        <p>Description</p>
                                        <textarea
                                            placeholder="Деньги за булочку, автомобиль, кофе и т.д. Личная информация."
                                            name="descriptionExchange" id="descriptionExchange"></textarea>
                                        <p>Commission</p><span>Estimated confirmation time 1+ hour.</span>
                                        <div class="clearfix row commission">
                                            <div class="col-xs-5">
                                                <select>
                                                    <option>Стандарт</option>
                                                    <option>Стандарт</option>
                                                    <option>Стандарт</option>
                                                </select>
                                            </div>
                                            <div class="count col-xs-4"><span id="commission-exchange">0.00063506 BTC (3.61 USD)</span>
                                            </div>
                                            <div class="col-xs-3">
                                                <button type="submit" class="btn-main col-r">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="content3" class="section">
                            <div class="request-form">
                                <form action="/" method="post" name="request-form">
                                    <div class="form-head"><span class="exchange-currency">Currency:</span>
                                        <select>
                                            <option>Bitcoin</option>
                                            <option disabled class="inactive">Ripple</option>
                                            <option>Litecoin</option>
                                            <option disabled class="inactive">Dogecoin</option>
                                            <option>Dash</option>
                                            <option>Ethereum</option>
                                            <option>Peercoin</option>
                                        </select>
                                    </div>
                                    <div class="form-body">
                                        <div class="clearfix address"><span class="col-r">View QR Code </span>
                                            <p>Copy & Share Address</p>
                                            <div class="col-r btn-main">COPY</div>
                                            <input type="text" placeholder="17Umc9GYtW2EoGC5XuVQpsutU4b2vh5P9f" name="">
                                        </div>
                                        <p>Enter Amount:</p>
                                        <div class="clearfix row">
                                            <label class="col-xs-5">
                                                <input type="number" placeholder="0.1000000" name="Amount" required
                                                       id="amount_from_input"><span
                                                    id="change-currency-from-btn">BTC</span>
                                            </label>
                                            <div class="col-xs-2">
                                                <a href="#" class="swap-fields"></a>
                                            </div>
                                            <label class="col-xs-5">
                                                <input type="number" placeholder="570" name="Amount" required
                                                       id="amount_to_input"><span id="change-currency-to-btn">USD</span>
                                            </label>
                                        </div>
                                        <p>Description</p>
                                        <textarea
                                            placeholder="Деньги за булочку, автомобиль, кофе и т.д. Личная информация."
                                            name="descriptionExchange" id="descriptionExchange"></textarea>
                                        <div class="addition-select">
                                            <p>Get on:</p>
                                            <div class="clearfix row">
                                                <div class="col-xs-4">
                                                    <select>
                                                        <option>Эйфелева башня</option>
                                                        <option>Эйфелева башня</option>
                                                        <option>Эйфелева башня</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-3 col-r">
                                                    <button type="submit" class="btn-main col-r">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="content4" class="section">
                            <div class="exchange-form">
                                <form action="/" method="post" name="exchange-form">
                                    <div class="clearfix exchange-form-head">
                                        <div class="col-2x">
                                            <p class="forn-name">SENT</p>
                                            <div class="exchange-select"><span class="sent-wallet">Wallet</span>
                                                <select id="sent-wallet" class="col-2x">
                                                    <option>One</option>
                                                    <option>Two</option>
                                                    <option>Three</option>
                                                </select>
                                            </div>
                                            <div class="exchange-select"><span class="sent-wallet">Currency</span>
                                                <select id="sent-currency" class="col-2x">
                                                    <option>Bitcoin</option>
                                                    <option disabled class="inactive">Ripple</option>
                                                    <option>Litecoin</option>
                                                    <option disabled class="inactive">Dogecoin</option>
                                                    <option>Dash</option>
                                                    <option>Ethereum</option>
                                                    <option>Peercoin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2x">
                                            <p class="forn-name">REQUEST</p>
                                            <div class="exchange-select"><span class="request-wallet">Wallet</span>
                                                <select id="request-wallet" class="col-2x">
                                                    <option>Two</option>
                                                    <option>One</option>
                                                    <option>Three</option>
                                                </select>
                                            </div>
                                            <div class="exchange-select"><span class="request-wallet"> Currency</span>
                                                <select id="request-currency" class="col-2x">
                                                    <option>Bitcoin</option>
                                                    <option disabled class="inactive">Ripple</option>
                                                    <option>Litecoin</option>
                                                    <option disabled class="inactive">Dogecoin</option>
                                                    <option>Dash</option>
                                                    <option>Ethereum</option>
                                                    <option>Peercoin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <p>Enter Amount:</p>
                                        <div class="clearfix row">
                                            <label class="col-xs-4">
                                                <input type="number" placeholder="0.1000000" name="amount_from" required
                                                       id="amount_from_input">
                                            </label>
                                            <div class="col-xs-4">
                                                <input type="number" placeholder="Курс обмена" name="course_exchange"
                                                       id="course_exchange">
                                            </div>
                                            <label class="col-xs-4">
                                                <input type="number" placeholder="570" name="amount_to" required
                                                       id="amount_to_input">
                                            </label>
                                        </div>
                                        <p>Commission</p>
                                        <div class="clearfix row commission">
                                            <div class="col-xs-4">
                                                <input type="number" placeholder="" name="">
                                            </div>
                                        </div>
                                        <div class="clearfix row">
                                            <button type="submit" class="btn-main col-r">Continue</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @foreach($user->wallets as $wallet)
        <div id="addWallet{{$wallet->symbol}}" class="modals-inner" style="display: none">
            <form action="{{route('balance.add-wallet', $wallet->id)}}" method="post" class="add-wallet-form" data-form="{{$wallet->id}}">
                @csrf
                <p class="headtitle">ADD WALLET</p>
                <div class="">
                    <label>
                        <input type="text" placeholder="Name Wallet" name="name_wallet" required="">
                    </label>
                    <input type="hidden" name="currency" value="3">
                </div>
                <div class="clearfix row">
                    <button type="submit" class="btn-main">@lang('generic.add_wallet')</button>
                </div>
            </form>
        </div>
    @endforeach
@stop
@section('js')
    @include('scripts.ccxt')

@stop
