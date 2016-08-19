<?php

namespace IssueTracker;

use App\Color;
use Illuminate\Database\Eloquent\Model;

/**
 * 標籤
 *
 * @property-read int id
 * @property string name
 * @property string color_id
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Issue[] issues
 *
 * @mixin \Eloquent
 */
class Label extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'name',
        'color',
    ];

    /* @var bool $timestamps 是否要有時戳 */
    public $timestamps = false;

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
