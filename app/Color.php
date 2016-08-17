<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use IssueTracker\Label;
use IssueTracker\Status;

/**
 * 顏色
 *
 * @property-read int id
 * @property string name
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Label[] labels
 * @property-read \Illuminate\Database\Eloquent\Collection|Status[] statuses
 *
 * @mixin \Eloquent
 */
class Color extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'name',
    ];

    /* @var bool $timestamps 是否要有時戳 */
    public $timestamps = false;

    public function labels()
    {
        return $this->hasMany(Label::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

}
