@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div id="wrapper">
    <div class="imgcontainer">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar"  width = "10">
    </div>
    <div class="container">
        <form action="" method="POST">
            @csrf
            <h1>Registration</h1>
            <p>
                <label for="firstname">First name:</label>
                <input id="name" type="text" name="firstName" value="{{ old('firstName') }}">
            </p>
            <p>
                <label for="lastname">Last name:</label>
                <input id="name" type="text" name="lastName" value="{{ old('lastName') }}">
            </p>
            <p>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}">
            </p>
            <p>
                <label for="email">Email address:</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}">
            </p>
            <p>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password">
            </p>
            <p>
                <label for="pwdrepeat">Repeat password:</label>
                <input id="pwdrepeat" type="password" name="password_confirmation">
            </p>
            <p>
                <label for="dob">Date of birth</label>
                <input id="dob" type="date" name="dob">
            </p>
            <p>
                <label for="nativelanguage">Native language</label>
                <select name="nativelanguage">
                    @foreach ($languages as $language)
                        <option value=" {{ $language->name }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </p>
            <button type="submit">Register</button>
        </form>
    </div>
</div>
@endsection
