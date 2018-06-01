@extends('layouts.app')

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

                </tr>
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