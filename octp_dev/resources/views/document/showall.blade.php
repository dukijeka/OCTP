@extends('layouts.app')

@section('content')
    <div class="prostor">

        <div id = "izbor">
            <form>
                <p>Translate from: </p>
                <select id="from">
                    @foreach ($language->all() as $lang)
                        <option id="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
                <p>Translate to: </p>
                <select id="to">
                    @foreach ($language->all() as $lang)
                        <option id="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
                <p>Sort by: </p>
                <select id="sort_date">
                    <option id="DNew">Date newest</option>
                    <option id="DOld">Date oldest</option>
                </select>
                <br><br><input type = "button" onClick="myF()" value = "Show"></input>
            </form>
        </div>

        <div id="text">

            @foreach ($documents->showAll() as $doc)
                <div class="docum" data-from = "{{(Language::find($doc->language_id))->name}}" data-to = "{{$doc->languages[0]->name}}" date-added="{{$doc->date_created}}">
                    <div class="title"></div>
                    <div class="fromto">
                        <div class="tfrom">From: {{(Language::find($doc->language_id))->name}}</div>
                        <div class="tto">To: {{$doc->languages[0]->name}}</div>
                    </div>
                    <div class="tekst">
                        <hr>
                        <p>
                            @foreach ($doc->sentences as $sent)
                                {{$sent->text}}&nbsp
                            @endforeach
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
