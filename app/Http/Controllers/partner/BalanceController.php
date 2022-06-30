<?php

namespace App\Http\Controllers\partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('partner.balance.index', compact('user'));
    }
}
