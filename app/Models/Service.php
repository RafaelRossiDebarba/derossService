<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    public function newService($description, $client_id) {
        $order = new Order;
        $order->newOrderClear();
        $id = Order::orderBy('id', 'desc')->first()->id;
        $service = new Service;
        $service->description = $description;
        $service->client_id = $client_id;
        $service->order_id = $id;
        $service->save();
    }

    public function updateService($id, $description) {
        $service = Service::find($id);
        $service->description = $description;
        $service->save();
    }
}
