<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model
{
    protected $fillable = [
        'user_id','phone','code'
    ];

    public static function clearOld(){
        self::where('created_at', '<', Carbon::now()->subMinutes(15)->toDateTimeString())->delete();
    }

    public static function checkCode ($user_id, $code){ // Проверяет код на правильность
        self::clearOld();
        $phone_code = self::where(['user_id'=>$user_id, 'code'=>$code])->first();
        if ($phone_code) {
            $phone_code->delete();
            return true;
        }
        return false;
    }

    public static function storeCode($user_id, $phone, $code){
        self::clearOld();
        $countFreshSended = self::where(['user_id'=>$user_id, 'phone'=>$phone])->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())->count();
        if ($countFreshSended==1) return false;
        self::create(['user_id'=>$user_id, 'phone'=>$phone, 'code'=>$code]);
        return true;
    }




}
