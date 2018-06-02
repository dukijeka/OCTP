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
        $doc = Document::find($request['id']);
        $user = Auth::user();

        if(Helper::hasUserReportedDocument($user, $doc)) {
            return response()->json(['error' => 'You already reported this document']);
        }
        if ($doc->user == $user) {
            return response()->json(['error' => 'You cannot report your own document']);
        }
        $report = new Report();
        $report->explanation = $request['explanation'];
        $report->date = Carbon::now();
        $report->user()->associate($user);
        $report->document()->associate($doc);

        $report->save();

        return response()->json(['success' => 'Document reported']);
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
     * @param  int $doc
     * @param int $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($doc, $user)
    {
        $report = Report::where('document_id', $doc)->
                          where('user_id', $user)->first();
        $author = User::find($report->user_id);
        $user = Auth::user();

        if(!$user->isAdminOrModerator()) {
            if($user != $author) {
                return back()->withErrors("You can not delete this report");
            }
        }
        $result = DB::delete('delete from report where document_id = ? and user_id = ?', [$doc, $author->id]);
        return back()->withSuccess('Report deleted');
    }
}
