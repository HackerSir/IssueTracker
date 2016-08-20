<?php

namespace App\IssueTracker;

/**
 * Class FilterPattern
 *
 *
 * @property-read string pattern 轉Pattern字串
 * @property-read array data 資料
 */
class FilterPattern
{
    /* @var string Pattern字串 */
    protected $pattern = '';
    /* @var array 資料，以陣列儲存各種條件 */
    protected $data = [
        'keyword' => [],
        'sort'    => 'created',
        'desc'    => true,
    ];

    /* @var array 有效pattern token類型 */
    protected static $validTokenTypes = ['sort:'];
    /* @var array 有效排序類型 */
    protected static $validSortTypes = ['created'];

    /**
     * 根據Pattern字串建立Pattern
     *
     * @param $patternString
     */
    public function __construct($patternString)
    {
        //TODO: 解析Pattern
        //依空白分割
        $tokens = preg_split("/[\s]+/", $patternString);
        foreach ($tokens as $token) {
            //token類型與參數
            $type = '';
            $argument = '';
            //是否為特殊token
            $isValidType = str_contains($token, static::$validTokenTypes);
            if ($isValidType) {
                //類型與參數
                list($type, $argument) = explode(':', $token, 2);
                //類型轉小寫
                $type = strtolower($type);
            }
            //有效類型，且參數不為空
            if ($isValidType && !empty($argument)) {
                //特殊token
                //TODO: 根據類型處理
                switch ($type) {
                    case 'sort':
                        //排序
                        $this->updateSort($argument);
                }
            } else {
                //非特殊token，即為關鍵字
            }
        }

        //將處理完的Pattern存入屬性
        $this->pattern = $patternString;
    }

    public function update(array $data)
    {
        //TODO: 更新Pattern
        foreach ($data as $key => $argument) {
            $key = strtolower($key);
            switch ($key) {
                case 'sort':
                    //排序
                    $this->updateSort($argument);
            }
        }
    }

    private function updateSort($argument)
    {
        if (str_contains($argument, '-')) {
            list($sort, $sc) = explode('-', $argument, 2);
        } else {
            $sort = $argument;
            $sc = 'desc';
        }
        //排序欄位
        if (in_array($sort, static::$validSortTypes)) {
            $this->data['sort'] = $sort;
        } else {
            $this->data['sort'] = array_first(static::$validSortTypes);
        }
        //排序（若非指定asc，即為desc）
        $this->data['desc'] = ($sc != 'asc');
        //更新pattern
        if (str_contains($this->pattern, 'sort:')) {
            $this->pattern = preg_replace("/(?<=sort:)([^\s]*)/", $argument, $this->pattern);
        } else {
            $this->pattern .= ' sort:' . $argument;
        }
    }

    /**
     * 產生Pattern字串
     *
     * @return string
     */
    private function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Magic getter
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $name = strtolower($name);
        switch ($name) {
            case 'pattern':
                return $this->getPattern();
            case 'data':
                return $this->data;
            default:
                return null;
        }
    }
}
