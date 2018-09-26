<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'my-twostep'], function () {
    Route::get('/', 'HomeController@index')->name('home');

});

Route::group(['middleware' => 'my-twostep'], function () {
    Route::get('bitfinex', 'BitfinexController@show')->name('show');
});


Auth::routes();


/*PROFILE ROUTE*/
Route::group(['middleware' => ['auth', 'my-twostep'], 'prefix' => 'profile'], function () {
    Route::get('', 'ProfileController@dashboard')->name('profile.dashboard');
    Route::post('profile-settings', 'ProfileController@profile_settings')->name('profile.settings');
    Route::view('write-phone', 'profile.write_phone')->name('profile.write-phone');
    Route::post('change-password', 'ProfileController@ChangePassword')->name('profile.change-password');
});


/*BALANCE ROUTE*/
Route::group(['middleware' => ['auth', 'my-twostep'], 'prefix' => 'balance'], function () {
    Route::get('', 'BalanceController@index')->name('balance.index');
    Route::post('add-wallet/{id}', 'BalanceController@add_wallet')->name('balance.add-wallet');
});




Route::match(['get', 'post'], 'logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
|  Verification Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'verification'], function () {

    Route::get('/mail-needed', 'TwoStepController@showVerification')->name('verificationNeeded');
    Route::post('/mail-verify', 'TwoStepController@verify')->name('verify');
    Route::post('/mail-resend', 'TwoStepController@resend')->name('resend');

    Route::get('phone-verify', 'SmsController@phone_verify')->name('phone-verify');
    Route::post('send-phone-code', 'SmsController@send')->name('send-phone-code');
    Route::post('confirm-code', 'SmsController@confirm_code')->name('confirm-code');

    Route::get('/phone-needed', 'SmsController@phone_needed')->name('verificationPhoneNeeded');
    Route::post('/confirm-code-needed', 'SmsController@confirm_code_needed')->name('confirmCodeNeeded');
    Route::post('/resend-phone-code', 'SmsController@resendPhoneCode')->name('resendPhoneCode');

});


Route::get('confirmation/resend', 'Auth\RegisterController@resend');
Route::get('confirmation/{id}/{token}', 'Auth\RegisterController@confirm')->name('register.confirm');





