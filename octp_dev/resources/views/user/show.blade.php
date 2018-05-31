@extends('layouts.app')

@section('content')
<form>
    <div class="imgcontainer">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar"  width = "10">
    </div>
    @if (Auth::user()->access_level == 10)
    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>
                    First name
                </th>
                <th>
                    Last name
                </th>
                <th>
                    Username
                </th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($users as $singleUser)
                <tr>
                    <td>
                        {{$singleUser->first_name}}
                    </td>
                    <td>
                        {{$singleUser->last_name}}
                    </td>
                    <td>
                        {{$singleUser->username}}
                    </td>
                    <td>
                        <form method="post" action="{{ url('user/promoteuser/'.Auth::id()) }}">
                            @csrf
                            <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                            <button type="submit" class="btn btn-primary" @if($singleUser->access_level == 5) disabled @endif>
                                Promote user
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ url('user/demoteuser/'.Auth::id()) }}">
                            @csrf
                            <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                            <button type="submit" class="btn btn-primary" @if($singleUser->access_level == 1) disabled @endif>
                                Demote user
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ url('user/deleteuser/'.Auth::id()) }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $singleUser->id }}" name="id">
                            <button type="submit" class="btn btn-danger">Delete user</button>                        
                        </form>
                    </td>
                </tr>
        @endforeach
        </table>
    </div>
    @endif

    <div class="container">
        <hr />
        <label for="name">
            <b>{{$user->first_name.' '.$user->last_name}}</b>
        </label> <br /> <hr>
        
        <label><b>My languages: </b></label> <br />
        <ul class="list-group">
            @foreach ($user->languages as $language)
                <li class="list-group-item">
                    {{ $language->name }}
                </li>
            @endforeach
        </ul>
    </div>
    <hr>

    <div class="container">
        <label> <b>Contributed to: </b></label> <br />

        <hr />

        <ul class="list-group">
            @foreach ($user->translations as $translation)
                <li class="list-group-item">
                    
                </li>
            @endforeach
        </ul>

        <a href="{{ url('user/'.$user->id.'/edit') }}" class = "dropbtn"><button type = "button">Edit My Profile</button></a>

        <a href="/document/create"><button type = "button"  class = "uplbtn">Upload new document</button></a>
    </div>

    <div class="container" style="background-color:#f1f1f1">

    </div>

  </form> 
@endsection