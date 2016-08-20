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
        //暫存至Session
        session(['filterPattern' => $pattern->pattern]);
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
        //暫存至Session
        session(['filterPattern' => $pattern->pattern]);
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
        //排序
        if (isset($patternData['sort']) && isset($patternData['desc'])) {
            $sort = $patternData['sort'];
            $desc = ((bool)$patternData['desc']) ? 'desc' : 'asc';
            //TODO: 不同類型的排序
            switch ($sort) {
                case 'created':
                    $queryBuilder->orderBy('created_at', $desc);
                    break;
            }
        }

        return $queryBuilder;
    }
}
