<?php

namespace App\Http\Controllers\partner;

use Illuminate\Http\Request;
use App\Services\SendEmail;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Order;
use App\Models\OrderDriver;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Partner\Profile\ProfileUpdateRequest;
use Carbon\Carbon;

class PartnerController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return view('partner.profile.main', compact('user'));
    }

    public function getNextTen()
    {
        $count = $_GET["count"];
        $orders = Order::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get();
        $orders_with_drivers = OrderDriver::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get();
        $ordersSimple = collect($orders);
        $ordersWithDrivers = collect($orders_with_drivers);
        $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number');

        $mergedOrders = $mergedOrders->skip($count)->take(10);
        $count = count($mergedOrders);
        return response()->json(array('html'=>view('partner._partials.load_orders', compact('mergedOrders'))->render(), 'count' => $count));
    }
    public function myOrders()
    {
        $orders = Order::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get();
        $orders_with_drivers = OrderDriver::whereHas('car', function($q){
            $q->where('user_id', auth()->user()->id);
        })->get();
        $total_orders_count = count($orders)+count($orders_with_drivers)-1;
        $current_page_n = 1;
        $ordersSimple = collect($orders);
        $ordersWithDrivers = collect($orders_with_drivers);
        $pagination_count = ceil($ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->count()/10);

        if (isset($_GET["page"])) {
            $current_page_n = $_GET["page"];
            $skip = 10*($current_page_n-1);

            $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->skip($skip)->take(10);
        } else {
            $mergedOrders = $ordersSimple->merge($ordersWithDrivers)->sortByDesc('order_number')->take(10);
        }

        $user = auth()->user();
        return view('partner.my_orders', compact('total_orders_count', 'mergedOrders', 'current_page_n', 'user', 'pagination_count'));
    }
    public function bookingResult($id, $with_driver=false)
    {
		$create_ticket = route('partner_ticket.index');
        if (!$with_driver) {

            $order = Order::find($id);
            $from = Carbon::parse($order->from_date);
            $to = Carbon::parse($order->to_date);
            $diffDays =  $to->diffInDays($from);
            $search_cars = route('cars.page');
		
            if ($order->status=="rejected") {
                return view('front.booking_results.rejected', compact('order', 'diffDays', 'search_cars'));
            }
            if ($order->status=="approved") {
				
                return view('front.booking_results.approved', compact('order', 'diffDays', 'create_ticket'));
            }
            if ($order->status=="in_process") {
                return view('front.booking_results.in_process', compact('order', 'diffDays', 'create_ticket'));
            }
        } else {
			$order = OrderDriver::find($id);
			$search_cars = route('cars.page');
			
			if ($order->status == "rejected") {
                return view('front.booking_results.rejected2', compact('order', 'search_cars'));
            }
            if ($order->status == "approved") {
				
                return view('front.booking_results.approved', compact('order', 'create_ticket'));
            }
            if($order->status == "in_process") {
                return view('front.booking_results.in_process2', compact('order', 'create_ticket'));
            }
		}


    }
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $data["sms_notification"] = isset($data["sms_notification"]) ? true : false;
        $data["notification"] = isset($data["notification"]) ? true : false;

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
        unset($data["password_confirmation"]);
        unset($data["old_pass"]);
        $user->update($data);

        return redirect()->back();
    }
    public function changeStatus(Request $request)
    {
        $order = "App\\".$request->model;
        $order = $order::find($request->order_id);
        $old_status = $order->status;
        $order->update([
            "status"=> $request->status
        ]);
        if ($order->status!=$old_status) {
            $user = $order->user;
            $redirect_profile_url = "";
            if ($user) {
                if ($user->role->alias == "client") {
                    $redirect_profile_url = route('client.index');
                }
                if ($user->role->alias == "partner") {
                    $redirect_profile_url = route('partner.index');
                }
                if ($user->role->alias == "admin") {
                    $redirect_profile_url = route('admin');
                }
            }
            if ($order->status == "in_process") {
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = null;
                    $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars'; // заголовок письма

                    if ($order->table == "order_drivers") {
                        $search_cars = route('cars_rent_with_driver.page');
                        $body = view('email.in_process2', compact('order'))->render();
                    }
                    if ($order->table == "orders") {
                        $search_cars = route('cars.page');
                        $body = view('email.in_process', compact('order'))->render();
                    }

                    SendEmail::sendMail($to, $title, $body);
                }
            }

            if ($order->status == "rejected") {
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = null;
                    $title = 'Ваша заявка на автомобиль отклонена - RentalCars'; // заголовок письма

                    if ($order->table == "order_drivers") {
                        $search_cars = route('cars_rent_with_driver.page');
                    }
                    if ($order->table == "orders") {
                        $search_cars = route('cars.page');
                    }

                    $body = view('email.rejected', compact('order', 'search_cars'))->render();
                    SendEmail::sendMail($to, $title, $body);
                }

            }
            if ($order->status == "approved") {

                $to = $order->email;
                if ($to) {
                    $order->approved_booking = Carbon::now()->format("Y-m-d H:i:s");

                    $title = 'Ваша заявка на автомобиль успешно принята - RentalCars'; // заголовок письма

                    if ($order->table == "order_drivers") {
                        $search_cars = route('cars_rent_with_driver.page');
                        $body = view('email.approved2', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                    }
                    if ($order->table == "orders") {
                        $search_cars = route('cars.page');
                        $body = view('email.approved', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                    }
                    SendEmail::sendMail($to, $title, $body);
                }

            }
        }


    }
}
