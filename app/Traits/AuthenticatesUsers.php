<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RedirectsUsers;
use App\Models\User;
use App\Models\Container;
use Session;
trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $containers = Container::where('archived', false)->get()->take(30);
        $expeditors = User::whereHas(
            'role', function($q){
            $q->where('alias', 'forwarder');
        })->where('archived', false)->get();
        $total_containers = Container::where('archived', false)->whereHas(
            'vins', function($q){
            $q->whereHas('dealer');
        })->orderBy('created_at')->get();
        $total_pages = (int)(ceil(count($total_containers)/30));
        $sealines=[
            "14"=>"APL",
            "2"=>"ARKAS",
            "15"=>"CMA CGM",
            "5"=>"COSCO",
            "6"=>"EVERGREEN",
            "4"=>"HAMBURG SUD",
            "7"=>"HAPAG-LLOYD",
            "104"=>"HYUNDAI",
            "10"=>"MAERSK",
            "1"=>"MSC",
            "88"=>"ONE",
            "17"=>"OOCL",
            "111"=>"SAFMARINE",
            "112"=>"SEALAND",
            "124"=>"SINOKOR",
            "69"=>"TURKON",
            "97"=>"WAN HAI",
            "18"=>"YANG MING",
            "13"=>"ZIM",
        ];

        return view('admin.containers.index', compact('containers', 'expeditors', 'sealines',
            'total_pages', 'total_containers'));
//        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where("email", $request->email)->where("password", $request->password)->first();
        if ($user) {
            $remember = isset($request->remember) ? true : false;
            Auth::login($user, $remember);
            if ($user->role->alias == "dealer") {
                Session::put('show_mess', true);
                foreach ($user->dealersMessages as $mess) {
                    $mess->read = $mess->read+1;
                    $mess->save();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {

        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
