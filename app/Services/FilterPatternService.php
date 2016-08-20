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
    public function renewPattern(Request $request)
    {
        $patternString = $request->get('filterPattern');
        //建立Pattern
        $pattern = new FilterPattern($patternString);
        $patternString = $pattern->pattern;
        //暫存至Session
        session(['filterPattern' => $patternString]);
    }

    /**
     * @param array $data
     */
    public function updatePattern(array $data)
    {
        //取出pattern
        $pattern = $this->getPattern();
        //更新
        $pattern->update($data);
    }

    /**
     * 從Session中取出Pattern字串
     *
     * @return string
     */
    public function getPatternString()
    {
        $patternString = session('filterPattern');

        return $patternString;
    }

    /**
     * 從Session中取出Pattern
     *
     * @return FilterPattern
     */
    public function getPattern()
    {
        $patternString = $this->getPatternString();
        $pattern = new FilterPattern($patternString);

        return $pattern;
    }

    /**
     * 將Pattern套用給queryBuilder
     *
     * @param Builder|\Eloquent $queryBuilder
     * @return mixed
     */
    public function applyToQueryBuilder($queryBuilder)
    {
        //取出pattern
        $pattern = $this->getPattern();
        $patternData = $pattern->data;

        // TODO: 根據Pattern資料修改QueryBuilder

        return $queryBuilder;
    }
}
