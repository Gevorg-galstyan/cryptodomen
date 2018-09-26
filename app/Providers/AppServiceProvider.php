<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'laravellocalization.supportedLocales' => [
                'en'  => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
                'ru'  => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'русский', 'regional' => 'ru_RU'],
                'de'  => ['name' => 'German', 'script' => 'Latn', 'native' => 'Deutsch', 'regional' => 'de_DE'],
                'zh'  => ['name' => 'Chinese (Simplified)', 'script' => 'Hans', 'native' => '简体中文', 'regional' => 'zh_CN'],
            ],

            'laravellocalization.useAcceptLanguageHeader' => true,

            'laravellocalization.hideDefaultLocaleInURL' => true
        ]);
    }
}
