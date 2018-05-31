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
                    <form method="post" action=""></form> {{-- odvratan hack da bi svaka forma radila, bez ovoga se prva forma ne renderuje --}}
                    </td>
                    <td>
                        @if ($singleUser->access_level == 5)
                        <form method="post" action="{{ url('user/demoteuser/'.Auth::id()) }}">
                            @csrf
                            <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                            <button type="submit" class="btn btn-primary" @if($singleUser->access_level == 1) disabled @endif>
                                Demote user
                            </button>
                        </form>
                        @else
                        <form method="post" action="{{ url('user/promoteuser/'.Auth::id()) }}">
                            @csrf
                            <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                            <button class="btn btn-primary" @if($singleUser->access_level == 5) disabled @endif>
                                Promote user
                            </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{ url('user/deleteuser/'.Auth::id()) }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $singleUser->id }}" name="id">
                            <button type="submit" id="deleteBtn" class="btn btn-danger">Delete user</button>                        
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
            @foreach ($contributions as $contribution)
                <li class="list-group-item">
                    <a style="color:black" href="{{ url('document/show/'.$contribution->id) }}">
                        {{ "Document ".$contribution->id }}
                    </a>
                </li>
            @endforeach
        </ul>
        <br>
        <a href="{{ url('user/'.$user->id.'/edit') }}" ><button class="btn btn-success" type = "button">Edit My Profile</button></a>

        <a href="/document/create"><button type = "button"  class = "btn btn-primary">Upload new document</button></a>
    </div>

    <div class="container" style="background-color:#f1f1f1">

    </div>

  </form> 
@endsection