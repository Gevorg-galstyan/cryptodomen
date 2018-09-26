<?php

namespace App\Listeners;

use App\Events\ConfirmPhone;
use App\Models\UserSetting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDefaultSettings
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
        $settings['confirmation_phone'] = false;
        $settings['confirmation_email'] = false;
        $settings['session'] = false;
        $settings['send_mail'] = false;
        $settings['change_api'] = false;
        $settings = UserSetting::create([
            'user_id' => $event->user->id,
            'setting' => json_encode($settings),
        ]);
        if ($settings){
            return true;
        }else{
            return false;
        }
    }
}
