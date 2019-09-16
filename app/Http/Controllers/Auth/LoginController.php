<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Contracts\Cache\Repository as Cache;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $maxAttempts = 5;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => new ReCaptcha($this->throttleKey($request)),
        ]);
    }
    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $getCacheValue = Cache::get($this->throttleKey($request));

        $exceptionArray = [$this->username() => [trans('auth.failed')]];

        if($getCacheValue > config('custom.reCaptcha.maxAttempts'))
        {
            $exceptionArray = ['reCaptcha' => $getCacheValue];
        }

        throw ValidationException::withMessages(
            $exceptionArray
        );
    }
}
