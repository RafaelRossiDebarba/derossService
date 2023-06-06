@extends('layouts.app')

@section('content')
<div class="container">
  <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#newProductModal">
    Novo
  </button>
  <div class="row justify-content-center">
    <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newProductModalLabel">Novo Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ url('/products/') }}">
              @csrf
              @method('POST')
              <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus>
              </div>
              <div class="form-group">
                <label for="qtd">QTD:</label>
                <input type="text" class="form-control" name="qtd" value="{{ $product->qtd }}" required autofocus>
              </div>
              <div class="form-group">
                <label for="price">Preço:</label>
                <input type="text" class="form-control" name="price" value="{{ $product->price }}" required autofocus>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="atualizar_colaborador" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
          <th scope="col">QTD</th>
          <th scope="col">Preço</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
        <tr>
          <th scope="row">{{ $product->id }}</th>
          <td>{{ $product->name }}</td>
          <td>{{ $product->qtd }}</td>
          <td>{{ $product->price }}</td>
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
                  <div class="form-group">
                    <label for="qtd">QTD:</label>
                    <input type="text" class="form-control" name="qtd" value="{{ $product->qtd }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}" required autofocus>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
    @if ($products->links()->paginator->hasPages())
    <div class="mt-4 p-4 box has-text-centered">
      {!! $products->links() !!}
    </div>
    @endif
    <script src="{{ asset('js/products.js') }}"></script>
  </div>

</div>
@endsection