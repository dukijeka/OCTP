<h1>
    Users
</h1>

@foreach ($users as $user)
    <div class="card card-body bg-light">
        <h3>
            {{$user->first_name}}
        </h3>
        <p>
            @foreach ($user->languages as $language)
                <p>
                    {{ $language->name }}
                </p>
            @endforeach
        </p>
    </div>
@endforeach