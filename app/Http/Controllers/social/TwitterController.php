<?php

namespace App\Http\Controllers\social;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Socialite;
use Auth;

class TwitterController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('twitter')->redirect();
    }
    public function TwitterCallback()
    {
        $twitterSocial =   Socialite::driver('twitter')->user();

        $create['name'] = $twitterSocial->getName();
        $create['first_name'] = $create['name'];
        $create['email'] = $twitterSocial->getEmail();
        $create['twitter_provider_id'] = $twitterSocial->getId();
        $create['password'] = md5(rand(1,10000));
        $create['role_id'] = Role::where('alias', 'client')->first()->id;

        $existUser = User::where('email',$create['email'])->first();
        if($existUser) {
            if(!$existUser->twitter_provider_id)
            {
                $existUser->twitter_provider_id = $create['twitter_provider_id'];
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
