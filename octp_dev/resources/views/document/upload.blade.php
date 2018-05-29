@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">

            <form action="/document/store" method="POST">

                <h1>Document upload</h1>

                <p>
                    <label for="typeChoice1">File</label>
                    <input type="radio" id="typeChoice1" name="typeChoice" checked>
                </p>

                <p>
                    <label for="typeChoice2">Text</label>
                    <input type="radio" id="typeChoice2" name="typeChoice">
                </p>

                <input type="file" id="file">

                <textarea id="text" cols="60" rows="20"></textarea>

                <p>
                    Document name
                    <input type="text" id="documentName">
                </p>

                <p>
                    Document language
                    <select name="srclanguage">
                        @foreach ($languages as $language)
                            <option value="{{ $language->name }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </p>

                <p>
                    Required language
                    <select name="dstlanguage">
                        @foreach ($languages as $language)
                            <option value="{{ $language->name }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </p>

                <button type="submit">Upload</button>

            </form>

        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </div>

@endsection
