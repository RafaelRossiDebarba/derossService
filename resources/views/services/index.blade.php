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
          <th scope="col">Client</th>
          <th scope="col">Order ID</th>
          <th scope="col">Service Value</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($services))
        @foreach($services as $service)
        <tr>
          <th scope="row">{{ $service->id }}</th>
          <td>{{ $service->description }}</td>
          <td>{{ $service->name }}</td>
          <td>{{ $service->order_id }}</td>
          <td>{{ $service->service_value }}</td>
          <td>
            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#productServiceModal{{ $service->id }}">
              Produtos
            </button>
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
                <h5 class="modal-title" id="updateServiceModalLabel{{ $service->id }}">Atualizar serviço</h5>
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

                  <div class="form-group">
                    <label for="service_value">Preço mão de obra:</label>
                    <input type="text" class="form-control" name="service_value" value="{{ $service->service_value }}" required autofocus>
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

        <div class="modal fade" id="productServiceModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="productServiceModalLabel{{ $service->id }}" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="productServiceModalLabel{{ $service->id }}">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                    @if (isset($order_products))
                    @foreach($order_products as $order_product_table)
                      @if($order_product_table->order_id == $service->order_id)
                      <div>
                        <p>Nome: {{ $order_product_table->name }} </p>
                        <p> Valor: {{ $order_product_table->price }} --- QTD:{{ $order_product_table->qtd }}</p>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editProductModal{{ $order_product_table->id }}">
                          Editar
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteProductOrder({{ $order_product_table->id }}, 'Terminar')">
                          Excluir
                        </button>
                      </div>
                      <div class="modal fade" id="editProductModal{{ $order_product_table->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel{{ $order_product_table->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editProductModalLabel{{ $order_product_table->id }}">Atualizar serviço</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{ url('/orders/product/'.$order_product_table->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="price">Preço:</label>
                                  <input type="text" class="form-control" name="price" value="{{ $order_product_table->price }}" required autofocus>
                                </div>

                                <div class="form-group">
                                  <label for="qtd">Quantidade:</label>
                                  <input type="text" class="form-control" name="qtd" value="{{ $order_product_table->qtd }}" required autofocus>
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
                      @endif
                    @endforeach
                    @endif
                </div>
                
                <form method="POST" action="{{ url('/orders/product/'.$service->order_id) }}">
                  @csrf
                  @method('POST')
                  <label for="product_id">Selecione um produo:</label>
                  <select name="product_id" id="product_id">
                  @foreach($products as $id => $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                  @endforeach
                  </select>

                  <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" class="form-control" name="price" value="{{ $order_product->price }}" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="qtd">Quantidade:</label>
                    <input type="text" class="form-control" name="qtd" value="{{ $order_product->qtd }}" required autofocus>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="update_service" class="btn btn-primary">Adicionar</button>
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