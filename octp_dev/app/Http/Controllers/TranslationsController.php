<?php

namespace App\Http\Controllers;

use App\Translation;
use App\Sentence;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TranslationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translations = Translation::where('user_id', Auth::id())->get();
        return view('translation.index')->with('translations', $translations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        info('entered');
        $data = $request->all();

        info("addTranslation(): " . join('', $data));

        $validator = Validator::make($data, [
            'text' => 'required|string|max:1000000',
            'sentenceId' => 'required|integer|exists:sentence,id'
        ]);

        if($validator->fails())
            return response()->json(['error' => $validator]);

        $sentence = Sentence::findOrFail($data['sentenceId']);

        // insert into db
        $t = new Translation();
        $t->user()->associate(Auth::user());
        $t->sentence()->associate($sentence);
        $t->language_id = $sentence->document->wantedLanguage()->id;
        $t->date = Carbon::now();
        $t->translation_text = $data['text'];

        $t->saveOrFail();


        return response()->json(['result' => 'Success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to edit translations']);
        }
        $translation = Translation::find($request['id']);
        if (Auth::id() != $translation->user->id) {
            return response()->json(['error' => 'You can only edit your own translations']);
        }
        $translation->translation_text = $request['newTranslation'];
        $translation->save();
        return response()->json(['success' => 'Translation updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::id()) {
            return back()->withErrors(['Only logged in users can delete translations']);
        }
        $translation = Translation::find($id);
        if ($translation->user->id != Auth::id()) {
            return back()->withErrors(['You can only delete your own translations']);
        }
        $translation->delete();
        return back()->withSuccess('Translation deleted');
    }
}
