<?php

namespace App\Http\Controllers;


use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\Laravel2StepTrait;
use App\Events\ConfirmPhone;
use App\Models\SmsVerification;
use App\Rules\Phone;
use Illuminate\Validation\Rule;
use Validator;

class SmsController extends Controller
{
    use Laravel2StepTrait;

    private $_authCount;
    private $_authStatus;
    private $_twoStepAuth;
    private $_remainingAttempts;
    private $_user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Set the User2Step Variables
     *
     * @return void
     */
    private function setUser2StepData()
    {
        $user = Auth::User();
        $twoStepAuth = $this->getTwoStepAuthStatus($user->id, 'phone');
        $authCount = $twoStepAuth->authCount;
        $this->_user = $user;
        $this->_twoStepAuth = $twoStepAuth;
        $this->_authCount = $authCount;
        $this->_authStatus = $twoStepAuth->authStatus;
        $this->_remainingAttempts = config('laravel2step.laravel2stepExceededCount') - $authCount;
    }

    /**
     * Validation and Invalid code failed actions and return message
     *
     * @param array $errors (optional)
     *
     * @return array
     */
    private function invalidCodeReturnData($errors = null)
    {
        $this->_authCount = $this->_twoStepAuth->authCount += 1;
        $this->_twoStepAuth->save();

        $returnData = [
            'message' => trans('laravel-verification.titleFailed'),
            'authCount' => $this->_authCount,
            'remainingAttempts' => $this->_remainingAttempts,
        ];

        if ($errors) {
            $returnData['errors'] = $errors;
        }

        return $returnData;
    }

    /**
     * Show the twostep verification form.
     *
     * @return \Illuminate\Http\Response
     */


    public function confirm_code(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|integer|digits:4'
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => true, 'message' => $validate->messages()->first()]);
        }

        if (SmsVerification::checkCode(Auth::id(), $request->code)) { //Сравнении совподение набранного кода
            Auth::user()->phone_verify = 1;
            event(new ConfirmPhone(Auth::user()));
            Auth::user()->save();
            return response()->json([
                'message' => __('success.phone_verify_successfully'),
                'success' => true,
                'redirect' => route('profile.dashboard')
            ]);
        }

        return response()->json([ // Код был неправильным отправляем назад
            'message' => __('errors.incorrect_confirmation_code'), // Код подтверждения неправильный
            'errors' => true
        ]);
    }


    public function send(Request $request)
    {
        $messages = [
            'phone.unique' => __('errors.user_exist', ['attribute' => __('generic.phone_exist')]),
        ];
        $validate = Validator::make($request->all(), [
            'phone' => ['required', 'regex:/[+][0-9]{7,12}/', Rule::unique('users')->ignore(Auth::id()), new Phone()],
        ], $messages);

        if ($validate->fails()) {
            return response()->json(['errors' => true, 'message' => $validate->messages()->first()]);
        }
        $code = rand(1000, 9999);
        $result = SmsVerification::storeCode(Auth::id(), $request->phone, $code);
        if ($result) {
            Auth::user()->phone = $request->phone;
            Auth::user()->save();
            // Ваш код подтверждения
            $request['text'] = __('auth.verify_code', ['code' => $code]);
            if (TwilioSms::send($request)) {
                return response()->json([
                    //  Выслали код на номер
                    'message' => __('success.send_successfully', ['number' => $request->phone]),
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'message' => __('errors.unexpected_error'),
                    'errors' => true,
                ]);
            }
        } else {
            // Получить код  можно раз в 5 минут! Обычно смс приходит в течении 1-2 минут!
            return response()->json([
                'message' => __('errors.get_the_code'),
                'errors' => true,
            ]);
        }
    }

    /**
     * Send sms .
     * Show the twostep verification view for phone.
     *
     * @return \Illuminate\Http\Response
     */
    public function phone_needed(Request $request)       //showVerification , return 4input view
    {
        if (!config('laravel2step.2stepForPhoneEnabled')) {
            abort(404);
        }
        $this->setUser2StepData();

        $twoStepAuth = $this->_twoStepAuth;

        if ($this->checkExceededTime($twoStepAuth->updated_at)) {
            $this->resetExceededTime($twoStepAuth);
        }

        $data = [
            'user' => $this->_user,
            'remainingAttempts' => $this->_remainingAttempts + 1,
        ];

        if ($this->_authCount > config('laravel2step.laravel2stepExceededCount')) {

            $exceededTimeDetails = $this->exceededTimeParser($twoStepAuth->updated_at);

            $data['timeUntilUnlock'] = $exceededTimeDetails['tomorrow'];
            $data['timeCountdownUnlock'] = $exceededTimeDetails['remaining'];

            return View('twostep.exceeded')->with($data);
        }

        $now = new Carbon();
        $sentTimestamp = $twoStepAuth->requestDate;

        $phone = Auth::user()->phone;
        $request['phone'] = $phone;
        $code = $this->generateCode();
        $request['text'] = __('auth.verify_code', ['code' => $code]);

        $twoStepAuth->authCode =  $code;
        $twoStepAuth->save();

        if (!$sentTimestamp) {
            if ($this->sendVerificationCodeNotification($twoStepAuth, 'phone', $request)) {
                return view('twostep.verificationphone', [
                    'message' => __('success.send_successfully', ['number' => $phone]),
                    'success' => true
                ])->with($data);

            } else {
                return back()->with([
                    'message' => __('errors.unexpected_error'),
                    'alert-type' => 'error',
                ]);
            }
        } else {
            $timeBuffer = config('laravel2step.laravel2stepTimeResetBufferSeconds');
            $timeAllowedToSendCode = $sentTimestamp->addSeconds($timeBuffer);
            if ($now->gt($timeAllowedToSendCode)) {
                if ($this->sendVerificationCodeNotification($twoStepAuth, 'phone', $request)) { //
                    $twoStepAuth->requestDate = new Carbon();
                    $twoStepAuth->save();

                    return view('twostep.verificationphone', [
                        'message' => __('success.send_successfully', ['number' => $phone]),
                        'success' => true
                    ])->with($data);
                } else {
                    return back()->with([
                        'message' => __('errors.unexpected_error'),
                        'alert-type' => 'error',
                    ]);
                }
            }
        }
        return view('twostep.verificationphone', [
            'message' => __('success.send_successfully', ['number' => $phone]),
            'success' => true
        ])->with($data);


    }

    public function confirm_code_needed(Request $request)
    {
        if (!config('laravel2step.2stepForPhoneEnabled')) {
            abort(404);
        }
        if ($request->ajax()) {
            $this->setUser2StepData();
            $validator = Validator::make($request->all(), [
                'v_input_1' => 'required|min:1|max:1',
                'v_input_2' => 'required|min:1|max:1',
                'v_input_3' => 'required|min:1|max:1',
                'v_input_4' => 'required|min:1|max:1',
            ]);

            if ($validator->fails()) {
                $returnData = $this->invalidCodeReturnData($validator->errors());
                return response()->json($returnData, 418);
            }

            $code = $request->v_input_1 . $request->v_input_2 . $request->v_input_3 . $request->v_input_4;
            $validCode  = $this->_twoStepAuth->authCode;

            if ($validCode != $code) {

                $returnData = $this->invalidCodeReturnData();

                return response()->json($returnData, 418);
            }

            $this->resetActivationCountdown($this->_twoStepAuth);

            $returnData = [
                'nextUri' => session('nextUri', '/'),
                'message' => trans('laravel-verification.titlePassed'),
            ];

            return response()->json($returnData, 200);

        } else {
            abort(404);
        }
    }

    public function resendPhoneCode(Request $request)
    {
        if (!config('laravel2step.2stepForPhoneEnabled')) {
            abort(404);
        }
        $this->setUser2StepData();

        $twoStepAuth = $this->_twoStepAuth;
        $sentTimestamp = $twoStepAuth->requestDate;

        $request['phone'] = Auth::user()->phone;
        $code =$this->generateCode();
        $request['text'] = __('auth.verify_code', ['code' => $code]);

        $twoStepAuth->authCode =  $code;
        $twoStepAuth->save();

        if (strtotime($sentTimestamp) > strtotime(Carbon::now()->subMinutes(5)->toDateTimeString())) {
            $returnData = [
                'title' => __('errors.unexpected_error'),
                'message' => __('errors.get_the_code'),
            ];
        } else {
            if ($this->sendVerificationCodeNotification($twoStepAuth, 'phone', $request)) {
                $twoStepAuth->requestDate = new Carbon();
                $twoStepAuth->save();
                $returnData = [
                    'title' => trans('laravel-verification.verificationEmailSuccess'),
                    'message' => __('success.send_successfully', ['number' => $request->phone]),
                ];
            } else {
                $returnData = [
                    'title' => __('errors.error'),
                    'message' => __('errors.unexpected_error'),
                ];
            }
        }


        return response()->json($returnData, 200);
    }

}
