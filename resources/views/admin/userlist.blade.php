<table>
    @foreach ($users as $user)
        <tr><td>{{$user->id}}</td><td>{{$user->name}}</td><td>{{$user->email}}</td>
            <td>
                @if(!$user->isadmin)
            <form method="POST" action="{{route("admin.makeadmin",['user'=>$user->id])}}">@csrf <input type="submit" value="make admin"></form>
            @endif
        </td>
    </tr>
    @endforeach
</table>