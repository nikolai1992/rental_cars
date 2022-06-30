<?php

namespace App\Http\Controllers\client;

use App\Models\Order;
use App\Models\OrderDriver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Client\Profile\ProfileUpdateRequest;
use DB;
use Carbon\Carbon;

class ClientController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        return view('clients.profile', compact('user'));
    }

    public function myOrders()
    {
        $total_orders_count = count(auth()->user()->orders)+count(auth()->user()->withDriverOrders)-1;
        $ordersSimple = collect(auth()->user()->orders);
        $ordersWithDrivers = collect(auth()->user()->withDriverOrders);
        $current_page_n = 1;

        if (isset($_GET["page"])) {
            $current_page_n = $_GET["page"];
            $skip = 10*($current_page_n-1);

            $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->skip($skip)->take(10);
        } else {
            $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->take(10);
        }

        $data = [
            "total_orders_count" => $total_orders_count,
            "current_count" => $total_orders_count>10 ? 10 : $total_orders_count,
            "ordersSimple" => $ordersSimple,
            "ordersWithDrivers" => $ordersWithDrivers,
            "ordersWithDrivers" => $ordersWithDrivers,
            "pagination_count" => ceil($ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->count()/10),
            "current_page_n" => $current_page_n,
            "mergedOrders" => $mergedOrders
        ];

        return view('clients.my_orders')->with($data);
    }
    public function bookingResult($id, $with_driver=false)
    {
        $create_ticket = route('client.my_orders');
        if (!$with_driver) {

            $order = Order::find($id);
            $from = Carbon::parse($order->from_date);
            $to = Carbon::parse($order->to_date);
            $diffDays =  $to->diffInDays($from);
            $search_cars = route('cars.page');

            if ($order->status == "rejected") {
                return view('front.booking_results.rejected', compact('order', 'diffDays', 'search_cars'));
            }
            if ($order->status == "approved") {

                return view('front.booking_results.approved', compact('order', 'diffDays', 'create_ticket'));
            }
            if ($order->status == "in_process") {
                return view('front.booking_results.in_process', compact('order', 'diffDays', 'create_ticket'));
            }
        } else {
            $order = OrderDriver::find($id);
            $search_cars = route('cars.page');

            if ($order->status == "rejected") {
                return view('front.booking_results.rejected2', compact('order', 'search_cars'));
            }
            if ($order->status == "approved") {

                return view('front.booking_results.approved', compact('order', 'diffDays', 'create_ticket'));
            }
            if ($order->status == "in_process") {
                return view('front.booking_results.in_process2', compact('order', 'diffDays', 'create_ticket'));
            }
        }


    }
    public function getNextTen()
    {
        $count = $_GET["count"];

        $ordersSimple = collect(auth()->user()->orders);
        $ordersWithDrivers = collect(auth()->user()->withDriverOrders);
        $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number');

        $mergedOrders = $mergedOrders->skip($count)->take(10);
        $count = count($mergedOrders);

        return response()->json(array('html'=>view('clients._partials.load_orders', compact('mergedOrders'))->render(), 'count' => $count));
    }
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if ($request->old_pass) {
            if (!Hash::check($request->old_pass, $user->password)) {
                return redirect()->back();
            }

            $this->validate($request, [
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($data["password"] != null) {
                $data['password'] = Hash::make($request->password);
            } else {
                $data['password'] = $user->password;
            }
        } else {
            unset($data["password"]);
        }

        $data["sms_notification"] = isset($data["sms_notification"]) ? true : false;
        $data["notification"] = isset($data["notification"]) ? true : false;
        unset($data["password_confirmation"]);
        unset($data["old_pass"]);

        $user->update($data);
        return redirect()->back();
    }

}
