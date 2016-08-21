<?php

namespace App\Services;

use App\IssueTracker\FilterPattern;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use IssueTracker\Status;

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
     * @param array $extraData 追加合併至$data的暫時性資料（只用於query建立，不會儲存）
     * @return mixed
     */
    public function applyToQueryBuilder($queryBuilder, $extraData = [])
    {
        //取出pattern
        $pattern = $this->getPattern();
        $patternData = array_merge($pattern->data, $extraData);
        // TODO: 根據Pattern資料修改QueryBuilder
        //狀態
        if (isset($patternData['is'])) {
            //指定狀態
            $is = $patternData['is'];
            //取出所有狀態與其ID
            $statusList = Status::pluck('name', 'id');
            $statusId = null;
            //找出指定狀態的ID
            //（因狀態大寫開頭、參數全小寫，因此需要逐一忽略大小寫比較）
            foreach ($statusList as $checkStatusId => $checkStatusName) {
                //逐一檢查
                if (strcasecmp($is, $checkStatusName) == 0) {
                    $statusId = $checkStatusId;
                    break;
                }
            }
            if ($statusId) {
                $queryBuilder->where('status_id', $statusId);
            }
        }
        //排序
        if (isset($patternData['sort']) && isset($patternData['desc'])) {
            $sort = $patternData['sort'];
            $desc = ((bool) $patternData['desc']) ? 'desc' : 'asc';
            //TODO: 不同類型的排序
            switch ($sort) {
                case 'created':
                    $queryBuilder->orderBy('created_at', $desc);
                    break;
                case 'comments':
                    $queryBuilder->join('comments', function ($join) {
                        $join->on('comments.issue_id', '=', 'issues.id');
                    })->groupBy('issues.id')
                        ->select((['issues.*', DB::raw('COUNT(comments.issue_id) as comment_count')]))
                        ->orderBy('comment_count', $desc);
                    break;
            }
        }
        //關鍵字
        if (isset($patternData['keyword']) && count($patternData['keyword']) > 0) {
            $keywords = $patternData['keyword'];
            $queryBuilder->where('title', 'like', '%' . implode('%', $keywords) . '%');
        }

        return $queryBuilder;
    }
}
