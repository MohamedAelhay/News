<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Contracts\Cache\Repository as Cache;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PhpParser\Node\Stmt\Case_;

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
            'g-recaptcha-response' => new ReCaptcha(Cache::get($request->ip())),
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
        Cache::increment($request->ip());

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')]
        ]);
    }

    public function showLoginForm(Request $request)
    {
        $reCaptcha = Cache::get($request->ip()) > config('custom.reCaptcha.maxAttempts') ? true : false;

        return view('auth.login', compact('reCaptcha'));
    }

    protected function sendLoginResponse(Request $request)
    {
        Cache::forget($request->ip());

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
