@extends('layouts.app')





@section('content')
    <main class="main">
        <section class="world_map">
            <img src="{{asset('static/img/content/world_map.jpg')}}" alt="">
            <div id="top-image"></div>
        </section>
        <section class="currency_chart">
            <div class="wrapper">
                <div class="tabs">
                    <input id="tab1" type="radio" name="tabs">
                    <label for="tab1">DASH</label>
                    <input id="tab2" type="radio" name="tabs" checked="">
                    <label for="tab2">XAU</label>
                    <input id="tab3" type="radio" name="tabs">
                    <label for="tab3">QAU</label>
                    <input id="tab4" type="radio" name="tabs">
                    <label for="tab4">ETC</label>
                    <input id="tab5" type="radio" name="tabs">
                    <label for="tab5">REP</label>
                    <input id="tab6" type="radio" name="tabs">
                    <label for="tab6">ETH</label>
                    <input id="tab7" type="radio" name="tabs">
                    <label for="tab7">BCH</label>
                    <input id="tab8" type="radio" name="tabs">
                    <label for="tab8">BTC</label>
                    <input id="tab9" type="radio" name="tabs">
                    <label for="tab9">EUR</label>
                    <input id="tab10" type="radio" name="tabs">
                    <label for="tab10">USD</label>
                    <div id="content1" class="section">
                        <div class="ct-chart-DASH ct-perfect-fourth"></div>
                        <img src="{{asset('static/img/content/diagramm1.jpg')}}" alt="">
                    </div>
                    <div id="content2" class="section">
                        <div class="ct-chart-XAU ct-perfect-fourth"></div>
                    </div>
                    <div id="content3" class="section">
                        <div class="ct-chart-QAU ct-perfect-fourth"></div>
                    </div>
                    <div id="content4" class="section">
                        <div class="ct-chart-ETC ct-perfect-fourth"></div>
                    </div>
                    <div id="content5" class="section">
                        <div class="ct-chart-REP ct-perfect-fourth"></div>
                    </div>
                    <div id="content6" class="section">
                        <div class="ct-chart-ETH ct-perfect-fourth"></div>
                    </div>
                    <div id="content7" class="section">
                        <div class="ct-chart-BCH ct-perfect-fourth"></div>
                    </div>
                    <div id="content8" class="section">
                        <div class="ct-chart-BTC ct-perfect-fourth"></div>
                    </div>
                    <div id="content9" class="section">
                        <div class="ct-chart-EUR ct-perfect-fourth"></div>
                    </div>
                    <div id="content10" class="section">
                        <div class="ct-chart-USD ct-perfect-fourth"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_company">
            <div class="wrapper_all">
                <div class="wrapper">
                    <div class="clearfix row">
                        <div class="col-xs-7">
                            <div class="maintitle">@lang('words.our_company')</div>
                            <div class="descr">
                                <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране
                                    и обеспечивает ее всем необходимым.</p>
                                <p>Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая
                                    строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_team">
            <div class="wrapper_all">
                <div class="wrapper">
                    <div class="clearfix row">
                        <div class="col-xs-7">
                            <div class="maintitle">{!! __('words.our_team') !!}</div>
                            <div class="descr">
                                <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране
                                    и обеспечивает ее всем необходимым.</p>
                                <p>Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая
                                    строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_blockchain">
            <div class="wrapper">
                <div class="maintitle">Как работает блокчейн</div>
                <div class="clearfix row columns-wrap">
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon1.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>А хочет пересалать деньги Б</p>
                        </div>
                    </div>
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon2.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>Транзакции передаются в сеть и собираются в новый блок</p>
                        </div>
                    </div>
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon3.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>Блоки рассылаются для проверки всем участникам системы</p>
                        </div>
                    </div>
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon4.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>Каждый участник записывает блок в свой экземпляр базы данных</p>
                        </div>
                    </div>
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon5.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>Блок попадает в «цепочку блоках», которая содержит информацию обо всех транзакциях</p>
                        </div>
                    </div>
                    <div class="col-xs-4 column">
                        <div class="img">
                            <img src="{{asset('static/img/content/icon6.png')}}" alt="">
                        </div>
                        <div class="text">
                            <p>Транзакция завершена</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_work">
            <div class="wrapper_all">
                <div class="wrapper">
                    <div class="clearfix row">
                        <div class="col-xs-7">
                            <div class="maintitle">Мы используем самые современные
                                <br>блокчейн технологии</div>
                            <div class="descr">
                                <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране
                                    и обеспечивает ее всем необходимым.</p>
                                <p>Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая
                                    строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
