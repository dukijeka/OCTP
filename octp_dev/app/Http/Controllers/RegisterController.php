<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function index() {
        return View('auth.register');
    }

    public function register(Request $request) {
        $messages = [
                    'dob.required' => 'The date of birth is required'
        ];
        $validator = Validator::make($request->all(), [
                                    'firstName' => 'required',
                                    'lastName' => 'required',
                                    'username' => 'required|unique:user',
                                    'email' => 'required|unique:user|email',
                                    'password' => 'required|confirmed',
                                    'gender' => 'required',
                                    'dob' => 'required'
                                    ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $user = new User();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password_hash = Hash::make($request->input('password'));
        $user->date_of_birth = $request->input('dob');
        $user->date_joined = Carbon::now();
        $user->access_level = 1;
        $user->rating = 0;
        $user->save();
        return redirect()->back()->withSuccess("Registration successful.");
    }
}
