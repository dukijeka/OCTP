<?php

namespace App\Http\Controllers;

use App\Document;
use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
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

        // everything is ok, create new document

        $document = new Document();
        $document->date_created = Carbon::now();
        $document->language_id = Language::all()->where('name', $data['srclanguage'])->first();
        $document->posting_user_id = Auth::id();

        // TODO: where to save text or file ? => we have to split it into sentences and add them to db
        // TODO: document table has no column for document name

        $document->save();

        // TODO: create wanted translations in db

        // TODO: display message to the user
        return redirect("/document/show/" . $document->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Display all documents.
     */
    public function showAll() {

        $allDocs = Document::all();

        return view('document.showall')->with('docs', $allDocs);
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
    public function destroy(Document $document)
    {
        //
    }
}
