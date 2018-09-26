<?php

namespace App\Http\Middleware;

use App\Models\UserSetting;
use Closure;
use App\Traits\Laravel2StepTrait;
use Illuminate\Support\Facades\Auth;

class Laravel2step
{
    use  Laravel2StepTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return $next($request);
        }

        if (!Auth::user()->phone_verify) {

            if (request()->url() != route('profile.write-phone')) {
                return redirect()->route('profile.write-phone')->with([
                    'message' => __('confirmation.write_phone'),
                    'alert-type' => 'info'
                ]);
            } else {
                return $next($request);
            }
        }


        $response = $next($request);
        $nextUri = $request->url();
        switch ($nextUri) {
            case route('verificationNeeded'):
            case route('verificationPhoneNeeded'):
            case route('register'):
            case route('logout'):
            case route('login'):
            case route('password.request'):
            case route('profile.write-phone'):
            case route('profile.settings'):
                break;

            default:

                if (Auth::check()) {
                    if (Auth::user()->settings) {
                        $settings = json_decode(Auth::user()->settings->setting);
                        config([
                            'laravel2step.laravel2stepEnabled' => $settings->confirmation_email ?? false,
                            'laravel2step.2stepForPhoneEnabled' => $settings->confirmation_phone ?? false
                        ]);

                    }
                        session(['nextUri' => $nextUri]);
                        if (config('laravel2step.2stepForPhoneEnabled')) {

                            if ($this->twoStepVerification($request, 'phone') !== true) {
                                return redirect()->route('verificationPhoneNeeded');
                            }
                        }
                        if (config('laravel2step.laravel2stepEnabled')) {
                            if ($this->twoStepVerification($request, 'email') !== true) {
                                return redirect()->route('verificationNeeded');
                            }
                        }

                }
                break;
        }
        return $response;
    }
}
