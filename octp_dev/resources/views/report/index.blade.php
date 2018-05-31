@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">

            <table>

                <th>Document id</th>
                <th>Document title</th>
                <th>Explanation</th>
                <th>Date</th>

            @foreach ($reports as $r)
                <tr>
                    <td>{{$r->document->id}}</td>
                    <td>{{$r->document->title}}</td>
                    <td>{{$r->explanation}}</td>
                    <td>{{$r->date}}</td>
                </tr>
            @endforeach

            </table>

        </div>

    </div>

@endsection
