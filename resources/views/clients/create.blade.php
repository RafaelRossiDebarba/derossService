@extends('layouts.app')

@section('content')

<div class="container">
  <p>New</p>
  <form>
    <div class="md-3">
      <label for="inputName" class="form-label">Nome</label>
      <input id="inputName" class="form-control">
    </div>

    <div class="md-3">
      <label for="inputFone" class="form-label">Telefone</label>
      <input id="inputFone" class="form-control">
    </div>

    <div class="md-3">
      <label for="inputAddress" class="form-label">Endereço</label>
      <input id="inputAddress" class="form-control">
    </div>

    <div class="md-3">
      <label for="inputNumber" class="form-label">Numero</label>
      <input id="inputNumber" class="form-control">
    </div>

    <div class="md-3">
      <label for="inputCity" class="form-label">Cidade</label>
      <input id="inputCity" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

@endsection
