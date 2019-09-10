<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    private $maxAttemptsForCaptcha;
    private $cache;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->maxAttemptsForCaptcha = env('MAX_ATTEMPTS_CAPTCHA', 3);

        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
//            'g-recaptcha-response' => 'recaptcha',
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
        $getCacheValue = $this->cache->get($this->throttleKey($request));
        if($getCacheValue > $this->maxAttemptsForCaptcha)
        {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
                'reCaptcha' => $getCacheValue,
            ]);
        }
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
