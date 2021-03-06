<?php

namespace App\Traits;


use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TwoStepAuth;
use App\Models\TwoStepPhone;
use App\Notifications\SendVerificationCodeEmail;
use App\Services\TwilioSms;

trait Laravel2StepTrait
{
    /**
     * Check if the user is authorized
     *
     * @param  Request $request
     *
     * @return boolean
     */
    public function twoStepVerification($request, $type)
    {
        $user = Auth::User();

        if ($user) {

            $twoStepAuthStatus = $this->checkTwoStepAuthStatus($user->id, $type);

            if ($twoStepAuthStatus->authStatus !== true) {
                return false;
            } else {
                if ($this->checkTimeSinceVerified($twoStepAuthStatus)) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }

    /**
     * Check time since user was last verified and take apprpriate action
     *
     * @param collection $twoStepAuth
     *
     * @return boolean
     */
    private function checkTimeSinceVerified($twoStepAuth)
    {
        $expireMinutes = config('laravel2step.laravel2stepVerifiedLifetimeMinutes');
        $now = Carbon::now();
        $expire = Carbon::parse($twoStepAuth->authDate)->addMinutes($expireMinutes);
        $expired = $now->gt($expire);

        if ($expired) {
            $this->resetAuthStatus($twoStepAuth);

            return true;
        }

        return false;
    }

    /**
     * Reset TwoStepAuth collection item and code
     *
     * @param collection $twoStepAuth
     *
     * @return collection
     */
    private function resetAuthStatus($twoStepAuth)
    {
        $twoStepAuth->authCode = $this->generateCode();
        $twoStepAuth->authCount = 0;
        $twoStepAuth->authStatus = 0;
        $twoStepAuth->authDate = NULL;
        $twoStepAuth->requestDate = NULL;

        $twoStepAuth->save();

        return $twoStepAuth;
    }

    /**
     * Generate Authorization Code
     *
     * @param integer $length
     * @param string $prefix
     * @param string $suffix
     *
     * @return string
     */
    private function generateCode(int $length = 4, string $prefix = '', string $suffix = '')
    {
        for ($i = 0; $i < $length; $i++) {
            $prefix .= random_int(0, 1) ? chr(random_int(65, 90)) : random_int(0, 9);
        }
        return $prefix . $suffix;

    }

    /**
     * Create/retreive 2step verification object
     *
     * @param int $userId
     *
     * @return collection
     */
    private function checkTwoStepAuthStatus(int $userId, $type)
    {
        if ($type == 'email') {
            $twoStep = '\App\Models\TwoStepAuth';
        } elseif ($type == 'phone') {
            $twoStep = '\App\Models\TwoStepPhone';
        }
        $twoStepAuth = ($twoStep)::firstOrCreate(
            [
                'userId' => $userId,
            ],
            [
                'userId' => $userId,
                'authCode' => $this->generateCode(),
                'authCount' => 0,
            ]
        );

        return $twoStepAuth;
    }

    /**
     * Retreive the Verification Status
     *
     * @param int $userId
     *
     * @return collection || void
     */
    protected function getTwoStepAuthStatus($userId, $type)
    {
        if ($type == 'email') {
            return TwoStepAuth::where('userId', $userId)->firstOrFail();
        } elseif ($type == 'phone') {
            return TwoStepPhone::where('userId', $userId)->firstOrFail();
        }
    }

    /**
     * Format verification exceeded timings with Carbon
     *
     * @param string $time
     *
     * @return collection
     */
    protected function exceededTimeParser($time)
    {
        $tomorrow = Carbon::parse($time)->addMinutes(config('laravel2step.laravel2stepExceededCountdownMinutes'))->format('l, F jS Y h:i:sa');
        $remaining = $time->addMinutes(config('laravel2step.laravel2stepExceededCountdownMinutes'))->diffForHumans(null, true);

        $data = [
            'tomorrow' => $tomorrow,
            'remaining' => $remaining,
        ];

        return collect($data);
    }

    /**
     * Check if time since account lock has expired and return true if account verification can be reset
     *
     * @param datetime $time
     *
     * @return boolean
     */
    protected function checkExceededTime($time)
    {
        $now = Carbon::now();
        $expire = Carbon::parse($time)->addMinutes(config('laravel2step.laravel2stepExceededCountdownMinutes'));
        $expired = $now->gt($expire);

        if ($expired) {
            return true;
        }

        return false;
    }

    /**
     * Method to reset code and count.
     *
     * @param collection $twoStepEntry
     *
     * @return collection
     */
    protected function resetExceededTime($twoStepEntry)
    {
        $twoStepEntry->authCount = 0;
        $twoStepEntry->authCode = $this->generateCode();
        $twoStepEntry->save();

        return $twoStepEntry;
    }

    /**
     * Successful activation actions
     *
     * @param collection $twoStepAuth
     *
     * @return void
     */
    protected function resetActivationCountdown($twoStepAuth)
    {
        $twoStepAuth->authCode = $this->generateCode();
        $twoStepAuth->authCount = 0;
        $twoStepAuth->authStatus = 1;
        $twoStepAuth->authDate = Carbon::now();
        $twoStepAuth->requestDate = null;

        $twoStepAuth->save();
    }

    /**
     * Send verification code via notify.
     *
     * @param array $user
     * @param string $deliveryMethod (nullable)
     * @param string $code
     *
     * @return void
     */
    protected function sendVerificationCodeNotification($twoStepAuth, $deliveryMethod = null, $request = null)
    {
        $user = Auth::User();

        if ($deliveryMethod === null) {
            $user->notify(new SendVerificationCodeEmail($user, $twoStepAuth->authCode));
        } else if ($deliveryMethod === 'phone') {
            TwilioSms::send($request);
        }
        $twoStepAuth->requestDate = Carbon::now();
        $twoStepAuth->save();
        return true;

    }

}
