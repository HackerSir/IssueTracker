<?php

namespace IssueTracker;

use App\Color;
use Illuminate\Database\Eloquent\Model;

/**
 * 狀態
 *
 * @property-read int id
 * @property string name
 * @property string color
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Issue[] issues
 * @property-read string icon
 *
 * @mixin \Eloquent
 */
class Status extends Model
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

    public function getIconAttribute()
    {
        switch ($this->name) {
            case 'Opened':
                return '<i class="red warning sign icon"></i>';
            case 'Reopened':
                return '<i class="orange warning sign icon"></i>';
            case 'Closed':
                return '<i class="green check circle icon"></i>';
            default:
                return '';
        }
    }
}
