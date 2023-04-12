@extends('layouts.app')

@section('content')

<div class="container">
  @if (Route::has('create-client'))
    <a class="btn btn-primary" type="button" href="{{ route('create-client') }}">
      Novo
    </a>
  @endif
  <div class="row justify-content-center">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Telefone</th>
          <th scope="col">Endereço</th>
          <th scope="col">Cidade</th>
          <th scope="col">Numero</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($clients))
          @foreach($clients as $client)
            <tr>
              <th scope="row">{{ $client->id }}</th>
              <td>{{ $client->name }}</td>
              <td>{{ $client->fone }}</td>
              <td>{{ $client->address }}</td>
              <td>{{ $client->city }}</td>
              <td>{{ $client->number }}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection
