<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()) {
            if (!auth()->user()->active) {
                Auth::logout();
                return redirect()->route('main.page');
            }
            if (auth()->user()->role->alias == "admin") {
                return redirect()->intended(route('admin'));
            }
            if (auth()->user()->role->alias == "client") {
                return redirect()->intended(route('client.profile'));
            }
            if (auth()->user()->role->alias == "partner") {
                return redirect()->intended(route('partner.index'));
            }

        }
        return redirect()->route('main.page');
    }
}
