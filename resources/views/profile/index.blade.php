@extends('layouts.app')

@section('content')
    <main class="main">
        <section class="profile-tab exchange-tab">
            <div class="wrapper">
                <div class="tabs clearfix">
                    <ul class="tabs_menu clearfix tabs_menu_side">
                        <li class="active"> <a href="#content-account">Аккаунт</a>
                        </li>
                        <li> <a href="#content-safe">Безопасность</a>
                        </li>
                        <li> <a href="#content-verify">Верификация</a>
                        </li>
                        <li> <a href="#content-history">История входов в систему</a>
                        </li>
                        <li> <a href="#content-deals">История сделок</a>
                        </li>
                        <li> <a href="#content-faq">Поддержка и частые вопросы</a>
                        </li>
                        <li> <a href="#content-news">Новости</a>
                        </li>
                        <li> <a href="#content-vacancy">Вакансии</a>
                        </li>
                        <li><a href="#content-info"> Информация</a>
                        </li>
                    </ul>
                    <div class="tabs_content tabs_content_side">
                        <div id="content-account" class="section active">
                            <div class="headtitle">Основные настройки аккаунта</div>
                            <div class="account-info">
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <label for="#userName">
                                            <p>Имя пользователя:</p>
                                        </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" placeholder="@lang('generic.name')" name="name" value="{{Auth::user()->name}}" required id="name">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <label for="#password">
                                            <p>Пароль:</p>
                                        </label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="password" placeholder="**********" name="password" required id="password">
                                    </div>
                                    <div class="col-xs-4 btn-wrap">
                                        <a href="#NewPassword" class="btn-main fancybox">Изменить</a>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <label for="#userEmail">
                                            <p>Адрес электронной почты:</p>
                                        </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="email" placeholder=" 09***9***@******com" name="email" value="{{Auth::user()->email}}" required id="email">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <label for="#userPhone">
                                            <p>Телефон:</p>
                                        </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="tel" placeholder=" 38-**0-***-**00" name="phone" value="{{Auth::user()->phone}}" required id="phone">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <label for="#Language">
                                            <p>Language:</p>
                                        </label>
                                    </div>
                                    <div class="col-xs-8">
                                        <p>русский, English , 中文 (简化) , 中文 (繁體)</p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <p>Account status:</p>
                                    </div>
                                    <div class="col-xs-8"><a href="" class="account-status">Активный </a><a href="" class="account-status"> Отключить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-safe" class="section">
                            <div class="headtitle">Настройки безопасности</div>
                            <div class="descr small-descr">
                                <p>Рекомендации по безопасности:</p>
                                <p>Настоятельно рекомендуем включить подтверждение действий по СМС (входа в систему, совершения сделок, вывода средств, смены Логина, смены пароля, смены е-мэил, смены настроек безопасности)</p>
                                <p>Настоятельно рекомендуем включить подтверждение действий по е-мэил (входа в систему, совершения сделок, вывода средств, смены Логина, смены пароля, смены е-мэил, смены настроек безопасности)</p>
                                <p>Настоятельно рекомендуется включить двухфакторную аутентификацию. См. раздел «Двухфакторная аутентификация» ниже.</p>
                                <p>Заблокируйте снятия в случае входа в аккаунт с нового IP-адреса в разделе "Снятия"</p>
                                <p>Задайте фразу для подтверждения снятия в разделе «Снятия»</p>
                                <p>Заблокируйте или отключите адреса снятия для всех валют в разделе "Снятия"</p>
                                <p>Отключите функцию "Оставить сеанс открытым", если вы работаете с общего компьютера или не хотите долго оставаться в системе.</p>
                                <p>Ограничьте доступ к своей учетной записи по IP-адресу в разделе «Сеансы»</p>
                            </div>
                            <div class="settings settings-safe">
                                @php($settings = json_decode($user->settings->setting))
                                <form action="{{route('profile.settings')}}" method="post" name="accountSettingsForm">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-xs-9"><b>Подтверждение по телефону</b>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch {{isset($settings->confirmation_phone) && $settings->confirmation_phone ? 'checked' : ''}}"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox" name="settings[confirmation_phone]"
                                                    {{isset($settings->confirmation_phone) && $settings->confirmation_phone ? 'checked' : ''}}
                                                >
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Подтверждения по е-мэил</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch {{isset($settings->confirmation_email) && $settings->confirmation_email ? 'checked' : ''}}"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox" name="settings[confirmation_email]"
                                                    {{isset($settings->confirmation_email) && $settings->confirmation_email ? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="strong">Добавьте 2-факторную аутентификацию по токену в приложении для Google Android или iPhone.</p>
                                    <p>Защищенные действия:</p>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Входы</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Подтверждения снятий</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Изменения пароля</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Создание ключа API</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Изменения в настройках безопасности</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9">
                                            <p>Кардинальные изменения в настройках аккаунта</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <p class="strong">Сеанс</p>
                                    <div class="row clearfix">
                                        <div class="col-xs-9"><b>Оставить сеанс открытым</b>
                                            <p>Если вы авторизованы в системе, но неактивны, браузер будет пинговать платформу каждые 10 минут, чтобы сеанс не закрылся. Если эта функция отключена, сеанс закроется после 30 минут простоя.</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch {{isset($settings->session) && $settings->session ? 'checked' : ''}}"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox" name="settings[session]"
                                                    {{isset($settings->session) && $settings->session? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9"><b>Отправлять письмо при входе в систему</b>
                                            <p>При каждом входе в учетную запись вы будете получать электронное письмо с информацией об IP-адресе авторизованного пользователя и ссылкой для блокировки учетной записи на случай несанкционированных действий
                                                в ней.</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox" name="settings[send_mail]"
                                                    {{isset($settings->send_mail) && $settings->send_mail  ? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9"><b>Не завершать сессию при изменении моего IP адреса</b>
                                            <p>Установите флажок, если вы хотите, чтобы сессия не закрывалась при изменении IP-адреса (например, при переходе вашего мобильного устройства с Wi-Fi на LTE).</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch {{isset($settings->change_api) && $settings->change_api ? 'checked' : ''}}"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox" name="settings[change_api]"
                                                    {{isset($settings->change_api) && $settings->change_api ? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-xs-9"><b>Белый список IP-адресов</b>
                                            <p>Ограничьте доступ к аккаунту по IP-адресу. Можно указать один или несколько IP-адресов либо их диапазон.</p>
                                        </div>
                                        <div class="col-xs-3 switch-wrap">
                                            <label class="switch"><i class="icon-ok"></i><i class="icon-remove"></i>
                                                <input type="checkbox">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn-main">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="content-verify" class="section">
                            <div class="settings settings-verify">
                                <div class="headtitle">Верификация</div>
                                <div class="row clearfix">
                                    <div class="col-xs-4"><b>Подтверждения е-мэил</b>
                                    </div>
                                    <div class="col-xs-4"><b class="active">Подвержден</b>
                                    </div>
                                    <div class="col-xs-4"><a href="#confirmEmail" class="btn-main fancybox">Изменить</a>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4"><b>Подтверждения телефона</b>
                                    </div>
                                    <div class="col-xs-4"><b class="active">Подвержден</b>
                                    </div>
                                    <div class="col-xs-4"><a href="#confirmPhone" class="btn-main fancybox">Изменить</a>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <p>Подтверждение личности</p>
                                    </div>
                                    <div class="col-xs-4"><b class="inactive">Не подтверждено</b>
                                    </div>
                                    <div class="col-xs-4"><a href="#" class="btn-main expanded">Подвердить</a>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <p>Подтверждение адреса</p>
                                    </div>
                                    <div class="col-xs-4"><b class="inactive">Не подтверждено</b>
                                    </div>
                                    <div class="col-xs-4"><a href="#" class="btn-main expanded">Подвердить</a>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-xs-4">
                                        <p>Соглашение</p>
                                    </div>
                                    <div class="col-xs-4"><b class="inactive">Не подтверждено</b>
                                    </div>
                                    <div class="col-xs-4"><a href="#" class="btn-main expanded">Подвердить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-history" class="section">
                            <div class="settings-history">
                                <div class="clearfix">
                                    <div class="col-r"><a href="#" class="btn-transp">CSV Export</a>
                                    </div>
                                    <h3 class="headtitle">История входов в систему</h3>
                                    <p>Ноябрь 06 2017 — Февраль 06 2018</p>
                                </div>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>USER AGENT</th>
                                            <th>MOBILE?</th>
                                            <th>LOCATION</th>
                                            <th>IP ADDRESS</th>
                                            <th>LOGIN TIME</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Windows 10, Chrome, 00.0.0000.00</td>
                                            <td>No</td>
                                            <td>Moscow, RU</td>
                                            <td>81.200.8.00</td>
                                            <td>06-02-18 10:56:48</td>
                                        </tr>
                                        <tr>
                                            <td>Windows 10, Chrome, 00.0.0000.00</td>
                                            <td>No</td>
                                            <td>Moscow, RU</td>
                                            <td>81.200.8.00</td>
                                            <td>06-02-18 10:56:48</td>
                                        </tr>
                                        <tr>
                                            <td>Windows 10, Chrome, 00.0.0000.00</td>
                                            <td>No</td>
                                            <td>Moscow, RU</td>
                                            <td>81.200.8.00</td>
                                            <td>06-02-18 10:56:48</td>
                                        </tr>
                                        <tr>
                                            <td>Windows 10, Chrome, 00.0.0000.00</td>
                                            <td>No</td>
                                            <td>Moscow, RU</td>
                                            <td>81.200.8.00</td>
                                            <td>06-02-18 10:56:48</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="content-deals" class="section">
                            <div class="settings-history table-responsive">
                                <div class="headtitle">История сделок</div>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Дата/время Trade ID</th>
                                        <th>Тип</th>
                                        <th>Валютная пара</th>
                                        <th>Количество</th>
                                        <th>Цена</th>
                                        <th>Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>03.02.2018 22:50 46636491</td>
                                        <td>sell</td>
                                        <td>DASH/BTC</td>
                                        <td>0.05825291</td>
                                        <td>0.069</td>
                                        <td>0.00401945</td>
                                    </tr>
                                    <tr>
                                        <td>02.02.2018 09:09 46188963</td>
                                        <td>buy</td>
                                        <td>DASH/RUB</td>
                                        <td>0.00160423</td>
                                        <td>29000</td>
                                        <td>46.52267</td>
                                    </tr>
                                    <tr>
                                        <td>02.02.2018 09:08 46188773</td>
                                        <td>buy</td>
                                        <td>DASH/RUB</td>
                                        <td>0.01691984</td>
                                        <td>29000</td>
                                        <td>490.67536</td>
                                    </tr>
                                    <tr>
                                        <td>02.02.2018 09:08 46188697</td>
                                        <td>buy</td>
                                        <td>DASH/RUB</td>
                                        <td>0.02314506</td>
                                        <td>29000</td>
                                        <td>671.20674</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="content-faq" class="section">
                            <div class="faq">
                                <div class="headtitle">FAQ</div>
                            </div>
                        </div>
                        <div id="content-news" class="section">
                            <div class="news">
                                <div class="headtitle">Новости</div>
                            </div>
                        </div>
                        <div id="content-vacancy" class="section">
                            <div class="vacancy">
                                <div class="headtitle">Вакансии</div>
                            </div>
                        </div>
                        <div id="content-info" class="section">
                            <div class="addition-info">
                                <div class="headtitle">Информация</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modals">
    <div id="NewPassword" class="modals-inner">
        <p class="headtitle">Введите новый пароль</p>
        <form action="{{route('profile.change-password')}}" method="post" name="NewPassword-form" id="NewPassword_form" class="form-validate">
            @csrf
                <div class="">
                    <input type="password" placeholder="New Password" name="pass1" id="pass1" required>
                </div>
            <label for="">&nbsp;</label>
                <div class="">
                    <input type="password" placeholder="Repeat Password" name="pass2" id="pass2" required>
                </div>
            <label for="">&nbsp;</label>

            <p id="req"><span style="color: red">*</span>Select the method to get the code.</p>
            <select id="select-box-change" name="select_box_change" type="text" required>
                <option disabled selected>Please Select</option>
                <option value="phone">To Phone</option>
                <option value="email">To Email</option>
            </select>
            <div class="btn-wrap">
                <button id="accept" type="submit" class="btn-main">Accept Password</button>
            </div>
        </form>
        <form action="" method="post" name="Code-pass" id="code_pass">
            <div class="step2">
                <p>вам отправлено смс с кодом, введите его в окошко</p>
                {{--<input type="number" placeholder="" name="smscode" required>--}}
                <p style="color: red" id="error"></p>
                <div class="btn-wrap">
                    <button  type="submit" class="btn-main">ПОДТВЕРДИТЬ</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <style type="text/css">
        #NewPassword input.ok + label:after{
            content: '\2714';
            color: green;
            font-size: 23px;
            position: absolute;
            margin-top: -37px;
            padding: 0px 5px;

        }
       #NewPassword input.no + label:after{
            content: '\2715';
            color: red;
            font-size: 23px;
            position: absolute;
            margin-top: -37px;
            padding: 0px 5px;

        }
        #NewPassword input {
            display: block;
            margin-bottom: 0px;
            width: 100%;
            height: 39px;
            background-color: white;
            border: 1px solid #d0d0d0;
            padding: 0 30px;
        }
        #NewPassword input[name="smscode"] {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            height: 39px;
            background-color: white;
            border: 1px solid #d0d0d0;
            padding: 0 30px;
        }
        #NewPassword select {
            display: block;
            margin-bottom: 25px;
            width: 100%;
            height: 39px;
            background-color: white;
            border: 1px solid #d0d0d0;
            padding: 0 30px;
        }
    </style>
    <script type="text/javascript">
        $(".form-validate").submit(function (e) {
            event.preventDefault();
            var $pass1 = $("#pass1").val();
            var $pass2 = $("#pass2").val();
            var $select  = $("#select-box-change").val();

            if(($pass1 == $pass2) && $pass1 != ''){
                $("#pass1").removeClass('no');
                $("#pass2").removeClass('no');
                $("#pass1").addClass('ok');
                $("#pass2").addClass('ok');
            }else{
                $("#pass1").removeClass('ok');
                $("#pass2").removeClass('ok');
                $("#pass1").addClass('no');
                $("#pass2").addClass('no');
            }

            if($select == null){
                $("#req").css("color", "red");
            }else{
                $("#req").css("color", "black");
            }
            if ($pass1 == $pass2 && $select != null && $pass1 != '') {

                form_validate(e, false);


            }
        });

    </script>
@stop
