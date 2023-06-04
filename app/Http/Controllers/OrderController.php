<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Service;
use App\Models\Client;
use App\Models\Product;

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

    public function product($id, Request $request) {
        $product_order = new OrderProduct;
        $product_order->newProduct($id, $request->product_id, $request->qtd, $request->price);
        return redirect('services');
    }

    public function editProduct($id, Request $request) {
        $product_order = new OrderProduct;
        $product_order->editProduct($id, $request->qtd, $request->price);
        return redirect('services');
    }

    public function deleteProduct($id) {
        $product = OrderProduct::find($id);
        $ok = false;
        if($product) {
            $product->delete();
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
                                    ])->with('success', 'Produto excluido com sucesso!');
        } else {
            return view('services.index', ['services' => $services, 
                                        'service' => $service, 
                                        'clients' => $clients, 
                                        'order' => $order, 
                                        'products' => $products,
                                        'order_product' => $order_product,
                                        'order_products' => $order_products,
                                    ])->with('success', 'Produto não foi excluido!');
        }
    }
}
