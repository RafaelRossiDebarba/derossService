<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Client;
use App\Models\Order;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::join('orders', 'orders.id', '=', 'services.order_id')
                        ->select('services.id', 'services.description', 'services.order_id', 'services.client_id','orders.service_value')
                        ->get();
        $clients = Client::all();
        
        $service = new Service;
        $order = new Order;

        return view('services.index', ['services' => $services, 'service' => $service, 'clients' => $clients, 'order' => $order]);
    }

    public function new(Request $request) {
        $service = new Service;
        $service->newService($request->description, $request->client_id);
        return redirect('services');
    }

    public function edit($id, Request $request) {
        $service = new Service;
        $service->updateService($id, $request->description);

        $id_order = Service::where('id', $id)
                        ->select('order_id')
                        ->first();
        $order = new Order;
        $order->updateOrder($id_order, $request->service_value);
        return redirect('services');
    }

    public function delete($id) {
        $service = Service::find($id);
        if ($service) {
            $service->delete();

            $services = Service::all();
            $service = new Service;
            return view('service.index', ['services' => $services, 'service' => $service])->with('success', 'Serviço excluído com sucesso!');
        } else {
            $services = Service::all();
            $service = new Service;
            return view('service.index', ['services' => $services, 'service' => $service])->with('error', 'Serviço não encontrado.');
        }
    }
}
