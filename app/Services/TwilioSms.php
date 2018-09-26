<?php

namespace App\Services;


use GuzzleHttp\Client;


class TwilioSms
{
    public static function send($request)
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_FROM_NUMBER');
        try {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/' . $accountSid . '/Messages.json',
                ['form_params' => [
                    'Body' =>  $request->text,
                    'To' => $request->phone,
                    'From' => $from
                ]]);
            if ($result->getStatusCode() == 201) return true;
            return false;

        } catch (\Exception $e) {
            return false;
        }
    }

}
