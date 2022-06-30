<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Locale;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (auth()->user()) {
            if(auth()->user()->role->alias=="admin")
            {
                return redirect()->intended(route('admin'));
            }
            if(auth()->user()->role->alias=="client")
            {
                return redirect()->intended(route('client.profile'));
            }
            if(auth()->user()->role->alias=="partner")
            {
                return redirect()->intended(route('partner.index'));
            }
            $this->redirectTo = route('admin');
        }
        $this->middleware('guest')->except('logout');
        $locale = Locale::getLocale() ? "/".Locale::getLocale() : Locale::getLocale();

        $this->redirectTo = $locale.$this->redirectTo;
    }
}
