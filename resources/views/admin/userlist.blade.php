@extends("layouts.app")

@section("content")

<h1 class="ml-[17%] mt-4 text-2xl font-medium">User List</h1>

<form action="{{ route('admin.createuser') }}"> <input class="border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 mx-[15.5%] mt-12 mb-2 px-1" type="submit" value="Créer un utilisateur"></form>

<table class="table-fixed w-[70%] mx-[15%] min-w-[550px]">
    @foreach ($users as $user)
        <tr class="border-slate-700 border-solid border-2">
            <td >{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if (!$user->isadmin)
                    <form method="POST" action="{{ route('admin.makeadmin', ['user' => $user->id]) }}">
                        @csrf
                        <input class="border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 px-1"  type="submit" value="rendre admin">
                    </form>
                @endif
            </td>
            <td class="flex flex-row-reverse">
                <form method="POST" action="{{ route('admin.banuser', ['user' => $user->id]) }}">
                    @csrf 
                    <input class="border-solid border-slate-700 border-2 bg-sky-600 hover:bg-sky-700 rounded text-slate-200 px-1" type="submit" value="Bannir">
                </form>
            </td>
        </tr>
    @endforeach
</table>
 @endsection