<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;
use Image;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with(compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $model = new User();

        return view('admin.users.create', compact('roles', 'model'));
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        if (isset($data["active"])) {
            $data["active"] = true;
        } else {
            $data["active"] = false;
        }

        $data["sms_notification"] = isset($data["sms_notification"]) ? true : false;
        $data["notification"] = isset($data["notification"]) ? true : false;

        if ($request->file('image')) {
            $logo = $request->file('image');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["image"] = $image;
        }

        User::create($data);

        return redirect()->route('users.index')->with(['flash_message' => trans('admins.user_created')]);

    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.edit')->with(compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        if ($data["password"] != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }
        if (isset($data["active"])) {
            $data["active"] = true;
        } else {
            $data["active"] = false;
        }

        $data["sms_notification"] = isset($data["sms_notification"]) ? true : false;
        $data["notification"] = isset($data["notification"]) ? true : false;

        if ($request->file('image')) {
            $logo = $request->file('image');
            $filename = random_int(10000000, 99999999).time().".".$logo->getClientOriginalExtension();
            Image::make($logo)->save(public_path('images/uploads/'.$filename));
            $image = '/images/uploads/'.$filename;
            $data["image"] = $image;
        }

        $user->update($data);

        return redirect()->route('users.index')->with(['flash_message' => trans('admins.user_updated')]);
    }

    public function destroy(User $user)
    {
        $result = $user->remove();

        return redirect()->route('users.index')->with($result);
    }
}