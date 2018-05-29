@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">

            <form action="" method="GET">
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
                    <input type="text">
                </p>
                <p>
                    Document language
                    <select name="srclanguage">
                        <option value="Serbian">Serbian</option>
                        <option value="English">English</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                    </select>
                </p>
                <p>
                    Required language
                    <select name="dstlanguage">
                        <option value="Serbian">Serbian</option>
                        <option value="English">English</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                    </select>
                </p>

                <button type="submit">Upload</button>

            </form>

        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </div>

@endsection
