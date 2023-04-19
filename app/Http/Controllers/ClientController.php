<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //

    public function index() {
        $itensPaginas = 8; // número de itens por página
        #$clients = Client::paginate($itensPaginas);
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

    public function edit($id, Request $request) {
        $client = new Client;
        $client->updateClient($id, $request->name, $request->fone, $request->address, $request->number, $request->city);
        return redirect("\clients");
    }

    public function delete($id) {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            $clients = Client::all();

            return view('clients.index', ['clients' => $clients])->with('success', 'Cliente excluído com sucesso!');
        } else {
            $clients = Client::all();
            return view('clients.index', ['clients' => $clients])->with('error', 'Cliente não encontrado.');
        }
    }

}
