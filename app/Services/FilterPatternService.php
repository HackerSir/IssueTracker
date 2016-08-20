<?php

namespace App\Services;

use App\IssueTracker\FilterPattern;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FilterPatternService
{
    /**
     * 根據請求更新Pattern，並暫存於Session
     *
     * @param Request $request
     */
    public function updatePattern(Request $request)
    {
        $patternString = $request->get('filterPattern');
        //建立Pattern
        $pattern = new FilterPattern($patternString);
        $patternString = $pattern->pattern;
        //暫存至Session
        session(['filterPattern' => $patternString]);
    }

    /**
     * 從Session中取出Pattern字串
     *
     * @return string
     */
    public function getPattern()
    {
        $pattern = session('filterPattern');

        return $pattern;
    }

    /**
     * 將Pattern套用給queryBuilder
     *
     * @param $queryBuilder
     * @return mixed
     */
    public function applyToQueryBuilder($queryBuilder)
    {
        /* @var Builder $queryBuilder */
        //取出pattern字串
        $patternString = session('filterPattern');
        //建立Pattern
        $pattern = new FilterPattern($patternString);
        $patternData = $pattern->data;

        // TODO: 根據Pattern資料修改QueryBuilder

        return $queryBuilder;
    }
}
