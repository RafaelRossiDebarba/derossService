<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qtd_clients = count(Client::all());
        $qtd_products = count(Product::all());
        $qtd_services = count(Service::all());

        return view('home', ['qtd_clients' => $qtd_clients, 'qtd_products' => $qtd_products, 'qtd_services' => $qtd_services]);
    }
}
