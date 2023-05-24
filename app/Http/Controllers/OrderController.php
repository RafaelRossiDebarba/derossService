<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    public function new(Request $request) {

    }

    public function edit($id, Request $request) {
        $order = new Order;
        $order->updateOrder($id, $request->service_value);
        return redirect('services');
    }
}
