<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CheckStatusAction;
use App\Services\Admin\OrderFunctions;
use App\Models\Car;
use App\Models\Order;
use App\Models\OrderDriver;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderUpdateRequest;
use App\Http\Requests\Admin\Order\OrderUpdateWithDriverRequest;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Kiev');
    }

    public function index()
    {
        //
        $orders = Order::whereHas('car', function($q){
            $q->where('rent_type', 'simple_rent');
        })->get()->sortByDesc('order_number');
        $ordersWithDriver = OrderDriver::whereHas('car', function($q){
            $q->where('rent_type', 'with_driver');
        })->get()->sortByDesc('order_number');

        return view('admin.orders.index', compact('orders', 'ordersWithDriver'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $title = "Редактирование заявки";
        $users = User::whereHas("role", function($q)
        {
            $q->where("alias", '!=', "admin")->orWhere('alias', "client")->orWhere('alias', "partner");
        })->pluck("email", "id");
        $cars = Car::where('saved', true)->whereHas('simpleRent')->get();

        return view('admin.orders.form', compact('order', "title", "users", 'cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function editWithDriver($id)
    {
        $title = "Редактирование заявки на бронирование с водителем";
        $order = OrderDriver::find($id);
        $users = User::whereHas("role", function($q)
        {
            $q->where("alias", '!=', "admin")->orWhere('alias', "client")->orWhere('alias', "partner");
        })->pluck("email", "id");
        $cars = Car::where('saved', true)->whereHas('driverRent')->get();

        return view('admin.orders.form2', compact('order', "title", "users", 'cars'));
    }
    public function updateWithDriver(OrderUpdateWithDriverRequest $request, $id)
    {
        $order = OrderDriver::find($id);
        $old_status = $order->status;
        $data = OrderFunctions::groupDataWithDriver($request);

        $order->update($data);
        OrderFunctions::checkStatusWithDriver($order, $old_status);

        Session::flash('flash_message', "Заявка на бронирование с водителем успешно обновлена");

        return redirect()->route('order.index');
    }
    public function update(OrderUpdateRequest $request, Order $order)
    {
        //
        $data = OrderFunctions::groupData($request);
        $old_status = $order->status;

        $order->update($data);
        (new CheckStatusAction())->checkStatus($order, $old_status);

        Session::flash('flash_message', "Заявка успешно обновлена");

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        Session::flash('flash_message', "Заказ успешно удален");

        return redirect()->back();
    }
}
