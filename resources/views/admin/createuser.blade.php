@extends("layouts.app")

@section("content")

<h1 class="ml-[17%] mt-4 text-2xl font-medium">Create user</h1>
<form method="POST" action="{{ route('admin.postuser') }}">
        @csrf
<table class=" w-[70%] mx-[15%] min-w-[400px] max-w-[550px]">
        <tr><td><label for="name">Nom</label></td>
            <td class="flex flex-row-reverse"><input class="w-[100%] border-solid border-2 border-slate-700 rounded " type="text" name="name" value="{{ old('name') }}" required autofocus /></tr></td>
            
        

        
            <tr>
                <td><label for="email">Email</label></td>
                <td class="flex flex-row-reverse"><input class="w-[100%] border-solid border-2 border-slate-700 rounded " type="email" name="email" value="{{ old('email') }}" required /></td>
            </tr>
        

        
            <tr>
                <td><label for="password">Mot de passe</label></td>
                <td class="flex flex-row-reverse"><input class="w-[100%] border-solid border-2 border-slate-700 rounded " type="password" name="password" required /></td>
            </tr>
        

        <tr>
            
                <td><label for="password_confirmation">Confirmer le mot de passe</label></td>
                <td class="flex flex-row-reverse"><input class="w-[100%] border-solid border-2 border-slate-700 rounded " type="password" name="password_confirmation" required /></td>
        </tr>
       

    <tr>
        <td></td>
                <td class="flex flex-row-reverse"><button class="w-[100%] border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 px-1" type="submit">Enregistrer</button></td>
                
    </tr>
        
</table>
<a class="text-sky-600 hover:text-sky-800 mx-[15%] underline" href="{{ route('admin.userlist') }}">Retour à la liste d'utilisateur</a>
    </form>
    @endsection