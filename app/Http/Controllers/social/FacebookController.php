<?php

namespace App\Http\Controllers\social;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Session;
use Auth;
use App\Models\User;
use App\Models\Role;

class FacebookController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
            $user = Socialite::driver('facebook')->stateless()->user();

            $create['name'] = $user->getName();
            $create['first_name'] = $create['name'];
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['password'] = md5(rand(1,10000));
            $create['role_id'] = Role::where('alias', 'client')->first()->id;

            $existUser = User::where('email',$create['email'])->first();
            if($existUser) {
                if(!$existUser->facebook_id)
                {
                    $existUser->facebook_id = $create['facebook_id'];
                    $existUser->save();
                }
                Auth::login($existUser, true);
            }
            else {
                $userModel = new User;
                $userModel = $userModel->create($create);
                Auth::login($userModel, true);
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
