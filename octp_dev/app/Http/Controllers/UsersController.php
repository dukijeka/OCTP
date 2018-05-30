<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Language;
use App\KnowsLanguage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            return view('user.show')->with('user', $user);
        }
        else {
            return back()->withErrors(['You can only view your own profile']);
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
            return back()->withErrors(['You can only edit your own profile']);
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
                return redirect('user/'.$user->id);
            }
            else {
                return back()->withErrors();
            }
        }
        else {
            return back()->withErrors(['You can only edit your own profile']);
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
        //
    }

    private function validateUpdate($data) {
        return Validator::make($data, [
            'firstName' => 'required|string',
            'lastName' => 'required|string'
        ]);
    }
}
