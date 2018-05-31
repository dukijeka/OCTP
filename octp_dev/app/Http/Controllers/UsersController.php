<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Language;
use App\KnowsLanguage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == Auth::id())
        {
            $user = User::find($id);
            $contributions = null;
            $users = null;
            if ($user->access_level == 10) {
                $users = User::where('access_level', 1)->orWhere('access_level', 5)->get();
            }
            return view('user.show')->with(['user' => $user, 
                                            'contributions' => $contributions,
                                            'users' => $users]);
        }
        else {
            return redirect('/home')->withErrors(['You can only view your own profile']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id == Auth::id()) {
            $user = User::find($id);
            $languages = Language::all();
            $userLanguages = [];
            foreach ($user->languages as $language) {
                $userLanguages[] = $language->name;
            }
            return view('user.edit')->with(['user' => $user, 
                                            'userLanguages' => $userLanguages,
                                            'languages' => $languages]);
        }
        else {
            return redirect('/home')->withErrors(['You can only edit your own profile']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id == Auth::id()) {
            $this->validate($request, [
                'language' => 'required'
            ], ['You must select at least one language']);
            if ($this->validateUpdate($request->all())) {
                $user = User::find($id);
                $user->first_name = $request->input('firstName');
                $user->last_name = $request->input('lastName');
                $selectedLanguages = $request->get('language');
                $userLangNames = [];
                foreach ($user->languages as $language) {
                    $userLangNames[] = $language->name;
                }
                foreach($userLangNames as $userLangName) {
                    if (!in_array($userLangName, $selectedLanguages)) {
                        $language = Language::where('name', $userLangName)->first();
                        $knows_language = KnowsLanguage::where('user_id', $user->id)->
                                                        where('language_id', $language->id);
                        $knows_language->delete();
                    }
                }
                foreach($selectedLanguages as $selectedLangName) {
                    if (!in_array($selectedLangName, $userLangNames)) {
                        $knows_language = new KnowsLanguage();
                        $language = Language::where('name', $selectedLangName)->first();
                        $knows_language->user()->associate($user);
                        $knows_language->language()->associate($language);
                        $knows_language->save();
                    }
                }
                $user->save();
                return redirect('user/'.$user->id)->withSuccess('Information updated!');
            }
            else {
                return back()->withErrors();
            }
        }
        else {
            return redirect('/home')->withErrors(['You can only edit your own profile']);
        }
    }

    /**
     * Change the user's password
     * 
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function changePass(Request $request, $id) {
        if ($id == Auth::id()) {
            $messages = [
                'pass.required' => 'Old password is required.',
                'newpass.required' => 'New password is required',
                'newpass.confirmed' => 'Passwords do not match'
            ];
            $request->validate([
                'pass' => 'required|string',
                'newpass' => 'required|string|confirmed'
            ], $messages);
            $user = User::find($id);
            if (!Hash::check($request->input('pass'), $user->password)) {
                return back()->withErrors(['Wrong password']);
            }
            if ($request->input('pass') == $request->input('newpass')) {
                return back()->withErrors(['New password must be different from the old password']);
            }
            $user->password = Hash::make($request->input('newpass'));
            $user->save();
            return redirect('user/'.$user->id)->withSuccess('Password updated!');
        }
        else {
            return redirect('/home')->withErrors(['You can only edit your own account']);
        }
    }

    /**
     * Change the user's email address
     * 
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function changeEmail(Request $request, $id) {
        if ($id == Auth::id()) {
            $request->validate([
                'email' => 'required|string|email'
            ]);
            $user = User::find($id);
            if ($request->input('email') == $user->email) {
                return back()->withErrors(['New email address cannot be the same as the old one']);
            }
            else {
                $user->email = $request->input('email');
                $user->save();
                return redirect('user/'.$user->id)->withSuccess('Email updated');
            }
        }
        else {
            return redirect('/home')->withErrors(['You can only edit your own account']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == Auth::id()) {
            $user = User::find($id);
            $user->delete();
            return response()->json(['success' => 'Deleted!']);
        }
        else {
            return response()->json(['error' => 'You can only delete your own account']);
        }
    }

    /**
     * Promote the specified user to a moderator
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function promoteUser(Request $request, $id) {
        if ($id == Auth::id() && Auth::user()->access_level == 10) {
            $user = User::find($request['id']);
            $user->access_level = 5;
            $user->save();
            return redirect('user/'.$id)->withSuccess('User promoted');
        }
        else {
            return back()->withErrors(['Only the administrator can promote users']);
        }
    }

    /**
     * Demote the specified user
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function demoteUser(Request $request, $id) {
        if ($id == Auth::id() && Auth::user()->access_level == 10) {
            $user = User::find($request['id']);
            $user->access_level = 1;
            $user->save();
            return redirect('user/'.$id)->withSuccess('User demoted');
        }
        else {
            return back()->withErrors(['Only the administrator can demote users']);
        }
    }

    /**
     * Delete the specified user account
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request, $id) {
        if ($id == Auth::id() && Auth::user()->access_level == 10) {
            $user = User::find($request['id']);
            $user->delete();
            return redirect('user/'.$id)->withSuccess('User deleted');
        }
        else {
            return back()->withErrors(['Only the administrator can delete user accounts']);
        }
    }

    /**
     * Validate the data before updating the database
     * @param array $data
     * @return bool
     */
    private function validateUpdate($data) {
        return Validator::make($data, [
            'firstName' => 'required|string',
            'lastName' => 'required|string'
        ]);
    }
}
