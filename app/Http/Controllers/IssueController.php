<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use IssueTracker\Issue;
use IssueTracker\Label;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::with('status', 'comments')->paginate();
        //參與者（僅顯示有參與過的使用者）
        $participants = User::has('comments', '>', 0)->get();
        //標籤
        $labels = Label::all();

        return view('issue.index', compact('issues', 'participants', 'labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: store issue
    }

    /**
     * Display the specified resource.
     *
     * @param  Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        $labels = Label::all();
        return view('issue.show', compact(['issue', 'labels']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        // TODO: update with ajax
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        // TODO: delete issue
    }
}
