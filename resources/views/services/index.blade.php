@extends('layouts.app')

@section('content')

<div class="container">
<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#newServiceModal">
    Novo
  </button>
  <div class="modal fade" id="newServiceModal" tabindex="-1" role="dialog" aria-labelledby="newServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newServiceModalLabel">Novo Servico</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ url('/services/') }}">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="description">Descrição:</label>
              <input type="text" class="form-control" name="description" value="{{ $service->description }}" required autofocus>
            </div>
            <label for="client_id">Selecione um cliente:</label>
            <select name="client_id" id="client_id">
            @foreach($clients as $id => $client)
              <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
            </select>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="update_Service" class="btn btn-primary">Atualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Descrição</th>
          <th scope="col">Client ID</th>
          <th scope="col">Order ID</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($services))
        @foreach($services as $service)
        <tr>
          <th scope="row">{{ $service->id }}</th>
          <td>{{ $service->description }}</td>
          <td>{{ $service->client_id }}</td>
          <td>{{ $service->order_id }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateServiceModal{{ $service->id }}">
              Editar
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteService({{ $service->id }}, '{{ $service->description }}')">
              Excluir
            </button>
          </td>
        </tr>

        <div class="modal fade" id="updateServiceModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="updateServiceModalLabel{{ $service->id }}" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateServiceModalLabel{{ $service->id }}">Atualizar servicee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ url('/services/'.$service->id) }}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" class="form-control" name="description" value="{{ $service->description }}" required autofocus>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="update_service" class="btn btn-primary">Atualizar</button>
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
  <script src="{{ asset('js/services.js') }}"></script>
</div>

@endsection

@section('scripts')
{{-- A função asset() é uma função do Laravel que gera uma URL completa para um arquivo localizado em sua pasta public --}}
@endsection