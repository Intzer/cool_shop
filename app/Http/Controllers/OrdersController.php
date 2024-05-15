<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;
        return view('orders.index', compact('orders'));
    }
}
