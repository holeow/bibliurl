<form action="{{route('admin.createuser')}}"> <input type="submit" value="Créer un utilisateur"></form>

<table>
    @foreach ($users as $user)
        <tr><td>{{$user->id}}</td><td>{{$user->name}}</td><td>{{$user->email}}</td>
            <td>
                @if(!$user->isadmin)
            <form method="POST" action="{{route("admin.makeadmin",['user'=>$user->id])}}">@csrf <input type="submit" value="rendre admin"></form>
            @endif
        </td>
        <td> <form method="POST" action="{{route('admin.banuser',['user'=> $user->id])}}">@csrf <input type="submit" value="Bannir"></form></td>
    </tr>
    @endforeach
</table>