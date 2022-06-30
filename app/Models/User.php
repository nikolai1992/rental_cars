<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);

        $user->active = isset($fields["active"]);
        $user->password = Hash::make($fields['password']);
        $user->save();

        return $user;
    }


    public function edit($fields)
    {
        $this->fill($fields);
        $this->active = isset($fields["active"]);
        $this->save();
    }

    public function remove()
    {

        if (auth()->user()->id === $this->id) {
            return ['flash_message' => trans('admins.self_delete')];
        }

        $this->delete();
        return ['flash_message' => trans('admins.user_deleted')];
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = Hash::make($password);
            $this->save();
        }
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id', 'id');
    }
    /**
     * $roles - array which we receive from middleware
     * Check if the user has a role from roles array - so we will know if user has access to the page
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has a role
     */
    public function hasRole($role)
    {
        if ($this->role()->where('alias', $role)->first()) {
            return true;
        }

        return false;
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function withDriverOrders()
    {
        return $this->hasMany(OrderDriver::class, 'user_id', 'id');
    }

    public function getUnresolvedOrders()
    {
        $orders = Order::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get()->where('status', 'in_process');
        $driver_orders_price = OrderDriver::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get()->where('status', 'in_process');
        $count_orders = count($orders);
        $count_driver_orders = count($driver_orders_price);

        return $count_orders+$count_driver_orders;
    }
    public function getUnresolvedOrdersPrice()
    {
        $orders_price = Order::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get()->where('status', 'in_process')->sum('total_price');
        $driver_orders_price = OrderDriver::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get()->where('status', 'in_process')->sum('price');

        return $orders_price+$driver_orders_price;
    }
    public function addNew($input)
    {
        $check = static::where('google_id',$input['google_id'])->first();
        if (is_null($check)) {
            return static::create($input);
        }

        return $check;
    }

}
