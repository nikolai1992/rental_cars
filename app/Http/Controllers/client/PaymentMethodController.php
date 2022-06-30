<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    //
    public function index()
    {
        return view('clients.payment_method.index');
    }
}
