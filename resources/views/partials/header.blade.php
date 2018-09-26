<header class="header">
    <div class="wrapper">
        <div class="clearfix row">
            <div class="col-xs-5">
                <a href="index.html" class="logo">
                    <img src="{{asset('static/img/content/logo.png')}}" alt="" class="logo-img">
                </a>
            </div>
            <div class="col-xs-7">
                <div class="menu-wrap">
                    <div class="app-menu">
                        <ul class="main-menu">

                            <li><a href="#">@lang('words.support')</a></li>

                            @guest

                                <li class="login"><a href="#signIn" class="fancybox">@lang('generic.sing_in')</a></li>
                            @else
                                <li><a href="{{route('balance.index')}}">@lang('words.balance')</a></li>
                                <li><a href="{{route('profile.dashboard')}}">@lang('generic.profile')</a></li>
                                <li class="login"><a href="{{route('logout')}}"
                                                     class="fancybox">@lang('generic.logout')</a></li>
                            @endguest
                            <li class="lang-switcher">
                                <div data-lang="name" class="current-lang"><span>{{ LaravelLocalization::getCurrentLocale() }}</span>
                                    <img src="{{asset('static/img/content/'.LaravelLocalization::getCurrentLocale().'-flag.png')}}" alt="{{ LaravelLocalization::getCurrentLocaleName() }}">
                                </div>
                            <div hidden="" style="display: none;" class="lang-list">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if($localeCode == LaravelLocalization::getCurrentLocale())
                                        @continue
                                    @endif
                                    <div data-lang="en" data-href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="lang">
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" style="text-decoration: none">
                                            <span>{{ $localeCode }}</span>
                                            <img src="{{asset('static/img/content/'.$localeCode.'-flag.png')}}" alt="{{ $properties['native'] }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="open-menu"><span></span>
            </div>
        </div>
    </div>
</header>
