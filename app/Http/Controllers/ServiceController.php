<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::join('orders', 'orders.id', '=', 'services.order_id')
                        ->join('clients', 'clients.id', '=', 'services.client_id')
                        ->select('services.id', 'services.description', 'services.order_id', 'services.client_id', 'clients.name','orders.service_value')
                        ->get();
        $clients = Client::all();
        $products = Product::all();
        $order_products = OrderProduct::join('products', 'products.id', '=', 'order_product.product_id')
                        ->select('products.name', 'order_product.id', 'order_product.qtd', 'order_product.price', 'order_product.order_id')
                        ->get();
        
        $service = new Service;
        $order = new Order;
        $order_product = new OrderProduct;

        return view('services.index', ['services' => $services, 
                                        'service' => $service, 
                                        'clients' => $clients, 
                                        'order' => $order, 
                                        'products' => $products,
                                        'order_product' => $order_product,
                                        'order_products' => $order_products,
                                    ]);
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
        $ok = false;
        if ($service) {
            $service->delete();
            $ok = true;
        } 

        $services = Service::join('orders', 'orders.id', '=', 'services.order_id')
                        ->join('clients', 'clients.id', '=', 'services.client_id')
                        ->select('services.id', 'services.description', 'services.order_id', 'services.client_id', 'clients.name','orders.service_value')
                        ->get();
        $clients = Client::all();
        $products = Product::all();
        $order_products = OrderProduct::join('products', 'products.id', '=', 'order_product.product_id')
                        ->select('products.name', 'order_product.id', 'order_product.qtd', 'order_product.price', 'order_product.order_id')
                        ->get();
        
        $service = new Service;
        $order = new Order;
        $order_product = new OrderProduct;

        if($ok) {
            return view('services.index', ['services' => $services, 
                    'service' => $service, 
                    'clients' => $clients, 
                    'order' => $order, 
                    'products' => $products,
                    'order_product' => $order_product,
                    'order_products' => $order_products,
            ])->with('success', 'Serviço excluído com sucesso!');
        } else {
            return view('services.index', ['services' => $services, 
                    'service' => $service, 
                    'clients' => $clients, 
                    'order' => $order, 
                    'products' => $products,
                    'order_product' => $order_product,
                    'order_products' => $order_products,
            ])->with('error', 'Serviço não foi excluido!');
        }
    }
}
