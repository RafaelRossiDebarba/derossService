@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
  <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Valor Serviço</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($orders))
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{ $order->id }}</th>
          <td>{{ $order->service_value }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('scripts')
{{-- A função asset() é uma função do Laravel que gera uma URL completa para um arquivo localizado em sua pasta public --}}
@endsection
