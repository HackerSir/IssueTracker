<?php

namespace App\Http\Controllers;

use App\Services\FilterPatternService;
use App\User;
use Illuminate\Http\Request;
use IssueTracker\Issue;
use IssueTracker\Label;

class IssueController extends Controller
{
    /**
     * @var FilterPatternService
     */
    private $filterPatternService;

    /**
     * IssueController constructor.
     * @param FilterPatternService $filterPatternService
     */
    public function __construct(FilterPatternService $filterPatternService)
    {
        $this->filterPatternService = $filterPatternService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Issue::with('status', 'comments');
        //套用Filter Pattern
        $queryBuilder = $this->filterPatternService->applyToQueryBuilder($queryBuilder);
        //取出Filter Pattern
        $filterPattern = $this->filterPatternService->getPattern();
        //分頁並取出結果
        $issues = $queryBuilder->paginate();
        //參與者（僅顯示有參與過的使用者）
        $participants = User::has('comments', '>', 0)->get();
        //標籤
        $labels = Label::all();

        return view('issue.index', compact('issues', 'participants', 'labels', 'filterPattern'));
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

    /**
     * Update pattern of filter
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateFilterPattern(Request $request)
    {
        //Update pattern of filter
        $this->filterPatternService->updatePattern($request);

        return redirect()->route('issue.index');
    }
}
