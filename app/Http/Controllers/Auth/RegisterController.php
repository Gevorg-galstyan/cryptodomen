<?php

namespace App\Http\Controllers\Auth;

use App\Traits\MyRegistersUsers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use MyRegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            'email.unique' => __('validation.already_exist', ['attribute' => __('generic.email')]),
            'reg_password.confirmed' => __('validation.confirmed', ['attribute' => __('generic.reg_password')]),
            'reg_password.required' => __('validation.required', ['attribute' => __('generic.reg_password')]),
            'reg_password.string' => __('validation.required', ['attribute' => __('generic.reg_password')]),
            'reg_password.min' => __('validation.required', ['attribute' => __('generic.reg_password')]),
        ];
        return Validator::make($data, [
            'name' => 'required|string|min:4|max:40',
            'email' => 'required|string|email|max:255|unique:users',
            'reg_password' => 'required|string|min:6|confirmed',
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['reg_password']),
        ]);
    }





//    public function register(Request $request)
//    {
//        $validate = $this->validator($request->all());
//        if ($validate->fails()) {
//            if ($request->ajax()) {
//                return response()->json(['errors' => $validate->messages()]);
//            } else {
//                return back()->with([
//                    'message' => __('errors.unexpected_error'),
//                    'alert-type' => 'warning'
//                ]);
//            }
//        }
//        if (!$request->ajax()) {
//            $user = $this->create($request->all());
//            if ($user){
//                Auth::login($user);
//                return redirect()->route('profile.dashboard')->with([
//                    'message' => __('success.create_successfully'),
//                    'alert-type' => 'success'
//                ]);
//            }
//        }
//
//    }
}
