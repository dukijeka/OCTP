@extends('layouts.app')

@section('title')
    {{$user->first_name . ' ' . $user->last_name}}
@endsection

@section('content')
<form>
    <div class="imgcontainer">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar"  width = "10">
    </div>

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
                    <a style="color:black" href="{{ url('document/'.$contribution->id) }}">
                        {{ "Document ".$contribution->id }}
                    </a>
                </li>
            @endforeach
        </ul>
        <br>
        <a href="{{ url('user/'.$user->id.'/edit') }}" ><button class="btn btn-success" type = "button">Edit My Profile</button></a>

        <a href="/document/create"><button type = "button"  class = "btn btn-primary">Upload new document</button></a>
        @if (Auth::user()->access_level == 10)
            <a href="{{ url('user/showAllUsers') }}" class="btn btn-primary">Show all users</a>
        @endif
    </div>

    <div class="container" style="background-color:#f1f1f1">

    </div>

  </form> 
@endsection

@section('script')
    <script>
        var $executed = false;
        $(document).ready(function() {
            $("#searchInput").keyup(function () {
                //alert('cao');
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2]; // username
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            });

        });

    </script>
@endsection