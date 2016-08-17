<?php

namespace IssueTracker;

use Illuminate\Database\Eloquent\Model;

/**
 * 標籤
 *
 * @property-read int id
 * @property string name
 * @property int color_id
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\IssueTracker\Issue[]|null issues
 *
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 * @mixin \Eloquent
 */
class Label extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'name',
        'color_id',
    ];

    /* @var int $perPage 分頁時的每頁數量 */
    protected $perPage = 20;

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
