@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @if (isset($users))
          @foreach($users as $user)
            <th>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user.name }}</td>
            </th>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection
