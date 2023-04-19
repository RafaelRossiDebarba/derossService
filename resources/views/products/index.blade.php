@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Lista de Produtos') }}</div>

        <div class="card-body">
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          @if (isset($products)) {{-- Caso não encontre nenhum produto --}}
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateProductModal{{ $product->id }}">
                    Editar
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProduct({{ $product->id }}, '{{ $product->name }}')">Excluir</button>
                </td>
              </tr>
              <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="updateProductModalLabel{{ $product->id }}">Atualizar Produto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ url('/products/'.$product->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="name">Nome:</label>
                          <input type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" id="atualizar_colaborador" class="btn btn-primary">Atualizar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
    <script src="{{ asset('js/products.js') }}"></script>
  </div>

</div>
@endsection