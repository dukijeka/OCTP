@extends('layouts.app')

@section('content')

    <script src="../../../public/js/users.js"></script>

    <div class="container">
        <input type="text" id="searchInput" onkeyup="filter();" placeholder="Search by username...">
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