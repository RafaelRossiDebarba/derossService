<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //

    public function index() {
        $clients = Client::all();

        return view('clients.index', ['clients' => $clients]);
    }

    public function show() {
        return view('clients.show');
    }

    public function create() {
        return view('clients.create');
    }

    public function new() {
        return view('clients.show');
    }

    public function edit() {
        return view('clietns.edit');
    }

    public function delete() {
        $clients = Client::all();

        return view('clients.index', ['clients' => $clients]);
    }

}
