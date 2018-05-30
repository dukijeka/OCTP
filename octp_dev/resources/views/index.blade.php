<h1>
    Users
</h1>

@section('content')

    <div class="container">
        <table>
            <tr>
                <td>User</td>
                <td colspan = "2">Name</td>
                <td>Rating</td>
                <td colspan = "2">Options</td>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>
                    <a href="#">{{$user->username}}</a>
                </td>
                <td> {{$user->firstname}} </td>
                <td> {{$user->lastname}} </td>
                <td> {{$user->rating}}</td>
                <td>
                    <button type="button" class="btn btn-danger">Delete Account</button>
                </td>
                <td>
                    if({{$user->accessLevel}} == 1)
                        <button type="button" class="btn btn-success">Promote to Moderator</button>
                    elseif({{$user->accessLevel}} == 2)
                        <button type="button" class="btn btn-success">Remove Moderator privileges</button>
                    endif;
                </td>
            </tr>
            @endforeach
        </table>
    </div>

@endsection