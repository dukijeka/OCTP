<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\KnowsLanguage;
use App\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $languages = Language::all();
        return view('auth.register')->with('languages', $languages);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'dob.required' => 'The date of birth is required'
        ];
        return Validator::make($data, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'username' => 'required|unique:user',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|confirmed',
            'dob' => 'required'], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date_of_birth' => $data['dob'],
            'date_joined' => Carbon::now(),
            'access_level' => 1,
            'rating' => 0
        ]);
        $knows_language = new KnowsLanguage();
        $language = Language::where('name', $data['nativelanguage'])->first();
        $user = User::where('username', $user->username)->first();
        $knows_language->user()->associate($user);
        $knows_language->language()->associate($language);
        $knows_language->save();
        return $user;
    }
}
