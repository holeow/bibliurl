@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <div>
        <p>Bonjour {{ auth()->user()->name }}, vous êtes bien connecté !</p>
        @if (auth()->user()->isadmin)
            <p><a class="text-sky-600 hover:text-sky-800  underline" href="/admin/">Acceder à la page d'administration</a></p>
        @endif
        {{-- <p>Bonjour {{ Auth::user()->name }}, vous êtes bien connecté !</p> --}}
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button class="border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 px-1" type="submit">Se déconnecter</button>
    </form>

    <hr>

@endsection