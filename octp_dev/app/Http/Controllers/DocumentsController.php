<?php

namespace App\Http\Controllers;

use App\Document;
use App\Language;
use App\Sentence;
use App\User;
use App\WantedTranslations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!Auth::check()) {
            return back()->withErrors(['You must be logged in to create new document']);
        }

        return view('document.upload')->with(['languages' => Language::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user is creating new document

        if(!Auth::check()) {
            return back()->withErrors(['You must be logged in to create new document']);
        }

        // validate input

        $data = $request->all();

        $validator = Validator::make($data, [
            'typeChoice' => 'required'
        ]);

        if($validator->fails()) {
            return redirect("/document/create")->withErrors($validator);
        }

        $choice = $data['typeChoice'];

        if($choice == 'typeChoice1') {
            // uploading document as file

            $validator = Validator::make($data, [
                'file' => 'file|max:1000000|mimes:txt'
            ]);

            if ($validator->fails()) {
                return redirect("/document/create")->withErrors($validator);
            }
        } else if($choice == 'typeChoice2') {
            // uploading document as text

            $validator = Validator::make($data, [
                'text' => 'required|string|max:1000000'
            ]);

            if ($validator->fails()) {
                return redirect("/document/create")->withErrors($validator);
            }
        }

        $validator = Validator::make($data, [
            'documentName' => 'required|string|max:50',
            'srclanguage' => 'required',
            'dstlanguage' => 'required'
        ]);

        if($validator->fails()) {
            return redirect("/document/create")->withErrors($validator);
        }

        if ($data['srclanguage'] == $data['dstlanguage']) {
            return redirect("/document/create")->withErrors("Source and destination languages must be different!");
        }

        // everything is ok, create new document



        $srcLanguage = Language::all()->where('name', $data['srclanguage'])->first();
        $destLanguage = Language::all()->where('name', $data['dstlanguage'])->first();

        $document = new Document();
        $document->date_created = Carbon::now();
        $document->language_id = $srcLanguage->id;
        $document->posting_user_id = Auth::id();
        $document->title = $data['documentName'];

        // TODO: where to save text or file ? => we have to split it into sentences and add them to db

        // TODO: document table has no column for document name

        $document->save();

        info("inserted document: " . $document->id);

        // create wanted translations in db
        $wantedTranslations = new WantedTranslations();
        $wantedTranslations->document()->associate($document);
        $wantedTranslations->language()->associate($destLanguage);
        $wantedTranslations->save();

        if($choice == 'typeChoice1') {
            // uploading document as file
            $file = $request->file('file');

            //info("uploadedFile: " . join("", file($file)));
            $this->addSentencesToDatabase($document, join("", file($file)));

        } else if($choice == 'typeChoice2') {
            // uploading document as text
            //info($data);
            $this->addSentencesToDatabase($document, $data['text']);
        }

        // TODO: display message to the user
        return redirect("/document/show/" . $document->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("document.show")->with(['doc' => Document::findOrFail($id)]);
    }

    /**
     * Display all documents.
     */
    public function showAll() {

        $allDocs = Document::all();

        return view('document.showall')->with('docs', $allDocs);
    }

    /**
     * Display user's documents.
     */
    public function my() {

        $user = User::find(Auth::id());

        $docs = $user->documents;

        return view('document.showall')->with('docs', $docs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $doc = Document::findOrFail($id);
        $user = User::find(Auth::id());

        if(!$user->isModerator() && !$user->isAdmin()) {
            // user is not moderator nor admin => he must be the owner in order to delete the document
            if (null == $doc->user || $user->id != $doc->user->id) {
                // user is not owner of this document
                return back()->withErrors("Only owner of document can delete it");
            }
        }

        $doc->delete();

        return redirect("/document/");
    }

    public function addSentencesToDatabase($document, $text) {
        //info("testlogssdkf");
        $sentences = explode(".", $text);
        foreach ($sentences as $sentenceText) {
            if (strlen(trim($sentenceText)) == 0) {
                continue; // skip empty strings
            }
            $sentence = new Sentence();
            $sentence->document()->associate($document);
            $sentence->text = $sentenceText;
            $sentence->save();
        }
    }
}