@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <br><br><br>

                    <h4>Stats</h4>

                        <br>

                        <p>Users: {{App\User::all()->count()}}</p>
                        <p>Documents: {{App\Document::all()->count()}}</p>
                        <p>Sentences: {{App\Sentence::all()->count()}}</p>
                        <p>Languages: {{App\Language::all()->count()}}</p>
                        <p>Translations: {{App\Translation::all()->count()}}</p>
                        <p>Ratings: {{App\Rating::all()->count()}}</p>
                        <p>Reports: {{App\Report::all()->count()}}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
