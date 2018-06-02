@extends('layouts.app')

@section('title', 'Reports')

@section('content')

    <div id="wrapper">

        <div class="container">

            <table>

                <tr>
                    <th>Document id</th>
                    <th>Document title</th>
                    <th>Explanation</th>
                    <th>Date</th>
                    <th>User</th>
                    <th></th>
                </tr>

            @foreach ($reports as $r)
                <tr>
                    <td>{{$r->document->id}}</td>
                    <td>{{$r->document->title}}</td>
                    <td>{{$r->explanation}}</td>
                    <td>{{$r->date}}</td>
                    <td>{{$r->user->fullName()}}</td>
                    <td> 
                    <form method="post" action="{{ route('report.destroy', ['doc' => $r->document->id,
                                                                            'user' => $r->user->id]) }}">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach

            </table>

        </div>

    </div>

@endsection
