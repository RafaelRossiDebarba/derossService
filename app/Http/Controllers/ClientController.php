<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //

    public function index() {
        $itensPaginas = 50;
        $clients = Client::paginate($itensPaginas);
        #$clients = Client::all();
        $client = new Client;

        return view('clients.index', ['clients' => $clients, 'client' => $client]);
    }

    public function new(Request $request) {
        $client = new Client;
        $client->newClient($request->name, $request->fone, $request->address, $request->number, $request->city);
        return redirect("clients");
    }

    public function edit($id, Request $request) {
        $client = new Client;
        $client->updateClient($id, $request->name, $request->fone, $request->address, $request->number, $request->city);
        return redirect("clients");
    }

    public function delete($id) {
        $client = Client::find($id);
        $itensPaginas = 50;
        if ($client) {
            $client->delete();

            $clients = Client::paginate($itensPaginas);
            $client = new Client;
            return view('clients.index', ['clients' => $clients, 'client' => $client])->with('success', 'Cliente excluído com sucesso!');
        } else {
            $clients = Client::paginate($itensPaginas);
            $client = new Client;
            return view('clients.index', ['clients' => $clients, 'client' => $client])->with('error', 'Cliente não encontrado.');
        }
    }

}
