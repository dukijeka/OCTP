<?php

namespace App\Http\Controllers;

use App\Document;
use App\Helpers\Helper;
use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("report.index")->with(['reports' => Report::all()]);
    }

    /**
     * Display a listing of user's reports.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        $user = Helper::getCurrentUser();
        return view("report.index")->with(['reports' => $user->reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doc = Document::findOrFail($request['docId']);
        $user = Helper::getCurrentUser();

        if(Helper::hasUserReportedDocument($user, $doc))
            return redirect("/document/" . $doc->id)->withErrors("You already reported this document");

        $report = new Report();
        $report->explanation = $request['explanation'];
        $report->date = Carbon::now();
        $report->user()->associate($user);
        $report->document()->associate($doc);

        $report->save();

        Helper::setSuccessMessage("Document reported");

        return redirect("/document/" . $doc->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $docId = $request['docId'];
        $author = User::findOrFail($request['userId']);
        $user = Helper::getCurrentUser();

        if(!$user->isAdminOrModerator()) {
            if($user != $author) {
                return back()->withErrors("You can not delete this report");
            }
        }

        $report = $author->reports()->where('document_id', $docId)->firstOrFail();

        // this doesn't work
        //$report->delete();

        DB::delete('delete from report where document_id = ? and user_id = ?', [$report->document_id, $author->id] );

        Helper::setSuccessMessage("Report deleted");

        //return redirect("/document/show/" . $docId);
        return back();
    }
}
