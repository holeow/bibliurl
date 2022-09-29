@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div>
            <div><p>Quelque chose s'est mal passé</p></div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <tr>
        
                    <td><label for="email">Email</label></td>
                    <td><input class="border-solid border-slate-700 border-2 rounded" type="email" name="email" value="{{ old('email') }}" required autofocus /></td>
            </tr>
        
        
                <tr>
                    <td><label for="password">Mot de passe</label></td>
                    <td><input class="border-solid border-slate-700 border-2 rounded" type="password" name="password" required/></td>
                </tr>
        
        
                <tr>
                    <td></td>
                    <td class="flex flex-row-reverse"><button class="border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 px-1" type="submit">Se connecter</button></td>
                </tr>
        
        </form>
    </table>
    <a class="text-sky-600 hover:text-sky-800  underline" href="{{ route('register') }}">S'inscrire</a>
@endsection