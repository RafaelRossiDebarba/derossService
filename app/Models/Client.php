<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    public function updateClient($id, $name, $fone, $address, $number, $city)
    {
        $client = Client::find($id);
        $client->name = $name;
        $client->fone = $fone;
        $client->address = $address;
        $client->number = $number;
        $client->city = $city;
        $client->save();
    }

    public function newClient($name, $fone, $address, $number, $city)
    {
        $client = new Client;
        $client->name = $name;
        $client->fone = $fone;
        $client->address = $address;
        $client->number = $number;
        $client->city = $city;
        $client->save();
    }
}
