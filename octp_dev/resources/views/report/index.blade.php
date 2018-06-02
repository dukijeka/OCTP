@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">

            <table>

                <tr>
                    <th>Document id</th>
                    <th>Document title</th>
                    <th>Explanation</th>
                    <th>Date</th>
                    <th></th>
                </tr>

            @foreach ($reports as $r)
                <tr>
                    <td>{{$r->document->id}}</td>
                    <td>{{$r->document->title}}</td>
                    <td>{{$r->explanation}}</td>
                    <td>{{$r->date}}</td>
                    <td> <a href="/report/destroy?docId={{$r->document->id}}">Delete</a> </td>
                </tr>
            @endforeach

            </table>

        </div>

    </div>

@endsection
