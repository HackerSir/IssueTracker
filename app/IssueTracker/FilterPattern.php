<?php

namespace App\IssueTracker;

/**
 * Class FilterPattern
 *
 * @package App\IssueTracker
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

    /**
     * 根據Pattern字串建立Pattern
     *
     * @param $patternString
     */
    public function __construct($patternString)
    {
        //TODO: 解析Pattern

        //將處理完的Pattern存入屬性
        $this->pattern = $patternString;
    }

    public function update(array $data)
    {
        //TODO: 更新Pattern
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
