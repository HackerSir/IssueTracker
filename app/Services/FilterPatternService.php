<?php

namespace App\Services;

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
        $pattern = $request->get('filterPattern');
        // TODO: 過濾Pattern

        //暫存至Session
        session(['filterPattern' => $pattern]);

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
        /** @var Builder $queryBuilder */
        //取出pattern
        $pattern = session('filterPattern');

        // TODO: 根據Pattern修改QueryBuilder

        return $queryBuilder;
    }
}
