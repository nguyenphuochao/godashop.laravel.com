<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Order;
use App\Models\Transport;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function index() {
        return view('order.index', []);
    }

    function show($orderId) {
        $order = Order::find($orderId);
        return view('order.show', ['order' => $order]);
    }
    
}
