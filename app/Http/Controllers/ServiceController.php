<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        $clients = Client::all();

        $service = new Service;

        return view('services.index', ['services' => $services, 'service' => $service, 'clients' => $clients]);
    }

    public function new(Request $request) {
        $service = new Service;
        $service->newService($request->description, $request->client_id);
        return redirect('services');
    }

    public function edit($id, Request $request) {
        $service = new Service;
        $service->updateService($id, $request->description);
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
