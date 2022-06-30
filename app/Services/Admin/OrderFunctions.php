<?php

namespace App\Services\Admin;

use App\Services\SendEmail;
use App\Models\Car;
use App\Models\Setting;
use Carbon\Carbon;

class OrderFunctions
{
    public static function groupDataWithDriver($request)
    {
        $data = $request->all();
        $data["date"] = Carbon::parse($data["date"])->format("Y-m-d H:i");
        $setting = Setting::first();
        $car = Car::find($request->car_id);
        $price = $car->{'price_per_hour_'.$request->time};
        $vat_tax_price = $car->getPriceFromPercentVat($price, $setting->vat_tax);
        $data["price"] = $price+$vat_tax_price;
    }

    public static function groupData($request)
    {
        $data = $request->all();
        $from = Carbon::parse($data["from_date"]);
        $to = Carbon::parse($data["to_date"]);
        $data["from_date"] = $from->format("Y-m-d H:i");
        $data["to_date"] = $to->format("Y-m-d H:i");
        $diffDays =  $to->diffInDays($from);
        $car = Car::find($request->car_id);
        $total_price_per_days = $car->simpleRentGetPrice($diffDays);
        $setting = Setting::first();
        $data["total_per_days"] = $total_price_per_days;
        $vat_tax_price = $car->getPriceFromPercentVat($total_price_per_days, $setting->vat_tax);
        $final_price = $total_price_per_days+$vat_tax_price;
        $data["vat_tax"] = $vat_tax_price;
        $data["another_location"] = isset($data["another_location"]) ? true : false;
        $data["total_price"] = $final_price;

        return $data;
    }

    public static function checkStatusWithDriver($order, $old_status)
    {
        if ($order->status != $old_status)
        {
            if ($order->status == "in_process") {
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = null;
                    $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars'; // заголовок письма
                    $search_cars = route('cars_rent_with_driver.page');
                    $body = view('email.in_process2', compact('order'))->render();
                    SendEmail::sendMail($to, $title, $body, $search_cars);
                }
            }

            if ($order->status == "rejected") {
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = null;
                    $title = 'Ваша заявка на автомобиль отклонена - RentalCars'; // заголовок письма
                    $search_cars = route('cars_rent_with_driver.page');
                    $body = view('email.rejected', compact('order', 'search_cars'))->render();
                    SendEmail::sendMail($to, $title, $body, $search_cars);
                }

            }
            if ($order->status == "approved") {
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
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = Carbon::now()->format("Y-m-d H:i:s");

                    $title = 'Ваша заявка на автомобиль успешно принята - RentalCars'; // заголовок письма
                    $search_cars = route('cars_rent_with_driver.page');
                    $body = view('email.approved2', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                    SendEmail::sendMail($to, $title, $body);
                }

            }
            $order->save();
        }
    }
    public static function checkStatus($order, $old_status)
    {
        if ($order->status != $old_status) {
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
                if($to)
                {
                    $order->approved_booking = null;
                    // заголовок письма
                    $title = 'Ваша заявка на автомобиль взята на рассмотрение - RentalCars';
                    $body = view('email.in_process', compact('order'))->render();
                    SendEmail::sendMail($to, $title, $body);
                }
            }

            if ($order->status == "rejected") {
                $to = $order->email;
                if ($to) {
                    $order->approved_booking = null;
                    $title = 'Ваша заявка на автомобиль отклонена - RentalCars'; // заголовок письма
                    $search_cars = route('cars.page');
                    $body = view('email.rejected', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                    SendEmail::sendMail($to, $title, $body);
                }

            }

            if ($order->status == "approved") {
                $to = $order->email;

                if ($to) {
                    $order->approved_booking = Carbon::now()->format("Y-m-d H:i:s");
                    $title = 'Ваша заявка на автомобиль успешно принята - RentalCars'; // заголовок письма
                    $search_cars = route('cars.page');

                    $body = view('email.approved', compact('order', 'search_cars', 'redirect_profile_url'))->render();
                    SendEmail::sendMail($to, $title, $body);
                }

            }

            $order->save();
        }
    }
}