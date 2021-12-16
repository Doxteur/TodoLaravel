@extends('layouts.template')
@section('compteur')
    <div class="container mt-4 mx-auto">
        <h1>Todos non terminé : {{ $numberOfTodos }}</h1>
        @forelse ($todos as $todo)
            <li class="list-group-item  ">
                {{ $todo->texte }}
            </li>

        @empty

        @endforelse
    </div>
@endsection
