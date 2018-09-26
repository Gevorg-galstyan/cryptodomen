<?php

namespace App\Http\Controllers;


use App\Events\ConfirmPhone;
use App\Traits\Laravel2StepTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use Laravel2StepTrait;
    public function dashboard()
    {
//        Auth::user()->phone_verify = 1;
//        event( new ConfirmPhone(Auth::user()));
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function profile_settings(Request $request)
    {
        $settings = [];
        if ($request->settings && is_array($request->settings)) {
            foreach ($request->settings as $setting => $v) {
                $settings[$setting] = true;
            }
        }
        $user = Auth::user();
        $user->settings->setting = json_encode($settings);
        $user->settings->save();

        return back()->with([
            'message' => __('success.update_success'),
            'alert-type' => 'success'
        ]);


    }

    public function ChangePassword(Request $request){
        $message = [
            'select_box_change.required' => __('validation.required', ['attribute' => __('generic.select_box_change')]),
            'select_box_change.string' => __('validation.required', ['attribute' => __('generic.select_box_change')]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => __('generic.reg_password')]),
            'password.required' => __('validation.required', ['attribute' => __('generic.reg_password')]),
            'password.string' => __('validation.required', ['attribute' => __('generic.reg_password')]),
            'password.min' => __('validation.required', ['attribute' => __('generic.reg_password')]),
        ];
        $validate = Validator::make($request->all(),[
            'password' => 'required|string|min:6|confirmed',
            'select_box_change' => [
                'required',
                'string',
                function($attribute, $value, $fail){
                    if($value === 'phone' || $value === 'email'){
                        return $value;
                    }else{
                        $fail($attribute.' is invalid.');
                    }
                }
                ]
        ], $message);

        if($validate->fails()){
            return response()->json([
                'errors' => $validate->messages()
            ]);
        }

        $selected = $request->select_box_change;
        $user                       = Auth::User();
        $twoStepAuth                = $this->getTwoStepAuthStatus($user->id, $selected);
        $authCount                  = $twoStepAuth->authCount;
        $authStatus                 = $twoStepAuth->authStatus;
        $remainingAttempts   = config('laravel2step.laravel2stepExceededCount') - $authCount;

        if ($this->checkExceededTime($twoStepAuth->updated_at)) {
            $this->resetExceededTime($twoStepAuth);
        }

        if ($authCount > config('laravel2step.laravel2stepExceededCount')) {

            $exceededTimeDetails = $this->exceededTimeParser($twoStepAuth->updated_at);

            $data['timeUntilUnlock']     = $exceededTimeDetails['tomorrow'];
            $data['timeCountdownUnlock'] = $exceededTimeDetails['remaining'];

            return View('twostep.exceeded')->with($data);
        }
        $now = new Carbon();
        $sentTimestamp = $twoStepAuth->requestDate;

        $request['phone'] = Auth::user()->phone;
        $code =$this->generateCode();
        $request['text'] = __('auth.verify_code', ['code' => $code]);

        $twoStepAuth->authCode =  $code;
        $twoStepAuth->save();

        if (!$sentTimestamp) {
            if ($this->sendVerificationCodeNotification($twoStepAuth, $selected, $request)) {
                $returnData = [
                    'title' => trans('laravel-verification.verificationEmailSuccess'),
                    'message' => function($selected){
                        if($selected === 'email'){
                            return trans('laravel-verification.verificationEmailSentMsg');
                        }elseif ($selected === 'phone'){
                            return __('success.send_successfully', ['number' => Auth::user()->phone]);
                        }
                    }
                ];
            } else {
                $returnData = [
                    'title' => __('errors.error'),
                    'message' => __('errors.unexpected_error'),
                ];
            }
        } else {
            $timeBuffer = config('laravel2step.laravel2stepTimeResetBufferSeconds');
            $timeAllowedToSendCode = $sentTimestamp->addSeconds($timeBuffer);
            if ($now->gt($timeAllowedToSendCode)) {
                if ($this->sendVerificationCodeNotification($twoStepAuth, $selected, $request)) {
                    $twoStepAuth->requestDate = new Carbon();
                    $twoStepAuth->save();

                    $returnData = [
                        'title' => trans('laravel-verification.verificationEmailSuccess'),
                        'message' => function($selected){
                            if($selected === 'email'){
                                return trans('laravel-verification.verificationEmailSentMsg');
                            }elseif ($selected === 'phone'){
                                return __('success.send_successfully', ['number' => Auth::user()->phone]);
                            }
                        }
                    ];
                } else {
                    $returnData = [
                        'title' => __('errors.error'),
                        'message' => __('errors.unexpected_error'),
                    ];
                }
            }
        }
        return response()->json($returnData, 200);
    }

}
