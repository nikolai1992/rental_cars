<?php

namespace App\Http\Controllers\social;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Socialite;
use Auth;
use App\Models\Role;
use App\Models\DoctorProfile;
use Session;

class AuthGoogleController extends Controller
{
    //
    public function redirect()
    {

        return Socialite::driver('google')->stateless()->redirect();
    }


    public function callback()
    {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existUser = User::where('email',$googleUser->email)->first();
            if($existUser) {
                if(!$existUser->google_id)
                {
                    $existUser->google_id = $googleUser->id;
                    $existUser->save();
                }
                Auth::login($existUser, true);
            }
            else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->first_name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->role_id = Role::where('alias', 'client')->first()->id;
                $user->password = md5(rand(1,10000));
                $user->save();
                Auth::login($user, true);
            }
        if(auth()->user()->role->alias=="client")
        {
            return redirect()->route('client.index');
        }
        if(auth()->user()->role->alias=="partner")
        {
            return redirect()->route('partner.index');
        }
    }
}
