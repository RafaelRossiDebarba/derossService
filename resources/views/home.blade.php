@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Quantidade de pessoas cadastradas: {{ $qtd_clients }}</p>
                    <p>Quantidade de produtos cadastrados: {{ $qtd_products }}</p>
                    <p>Quantidade de serviços: {{ $qtd_services }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
