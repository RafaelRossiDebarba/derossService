@extends('layouts.app')

@section('content')

<div class="container">
  @if (Route::has('create_client'))
  <a class="btn btn-primary" type="button" href="{{ route('create_client') }}">
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
            <td>
              <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateClientModal{{ $client->id }}">
                Editar
              </button>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteClient({{ $client->id }}, '{{ $client->name }}')">
                Excluir
              </button>
            </td>
          </tr>

          <div class="modal fade" id="updateClientModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="updateClientModalLabel{{ $client->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="updateClientModalLabel{{ $client->id }}">Atualizar Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ url('/clients/'.$client->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="name">Nome:</label>
                      <input type="text" class="form-control" name="name" value="{{ $client->name }}" required autofocus>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" id="update_client" class="btn btn-primary">Atualizar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
  <script src="{{ asset('js/clients.js') }}"></script>
</div>

@endsection

@section('scripts')
  {{-- A função asset() é uma função do Laravel que gera uma URL completa para um arquivo localizado em sua pasta public --}}
@endsection