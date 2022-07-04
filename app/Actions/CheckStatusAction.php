<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.07.2022
 * Time: 12:07
 */
namespace App\Actions;

use App\Services\SendEmail;
use Carbon\Carbon;

class CheckStatusAction
{
    public function checkStatus($order, $old_status)
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