<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function newOrderClear() {
        $order = new Order;
        $order->service_value = 0.0;
        $order->save();
    }

    public function updateOrder($id, $service_value) {
        $order = Order::find($id)->first();
        $order->service_value = $service_value;
        $order->save();
    }
}
