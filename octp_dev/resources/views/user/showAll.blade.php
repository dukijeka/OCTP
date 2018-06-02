@extends('layouts.app')

@section('title', 'Users')

@section('content')



    <div class="container">
        <input type="text" id="searchInput" placeholder="Search by username...">
        <table class="table table-striped" id="myTable">
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
                @if (!$singleUser->isAdmin())
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
                            @if ($singleUser->access_level == 5)
                            <form method="post" action="{{ url('user/demoteuser/') }}">
                                @csrf
                                <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                                <button type="submit" class="btn btn-warning">
                                    Demote user
                                </button>
                            </form>
                            @else
                            <form method="post" action="{{ url('user/promoteuser/') }}">
                                @csrf
                                <input type="hidden" value="{{ $singleUser->id }}" name="id"/>
                                <button class="btn btn-info">
                                    Promote user
                                </button>
                            </form>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{ url('user/deleteuser/') }}">
                                @csrf
                                @method('delete')
                                <input type="hidden" value="{{ $singleUser->id }}" name="id">
                                <button type="submit" id="deleteBtn" class="btn btn-danger">Delete user</button>                        
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>



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