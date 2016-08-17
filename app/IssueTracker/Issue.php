<?php

namespace IssueTracker;

use Illuminate\Database\Eloquent\Model;

/**
 * 提問
 *
 * @property-read int id
 * @property string title
 * @property int status_id
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\IssueTracker\Comment[]|null comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\IssueTracker\Label[]|null labels
 * @property-read \IssueTracker\Status|null status
 * @property-read \Illuminate\Database\Eloquent\Collection|\IssueTracker\History[]|null histories
 *
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 * @mixin \Eloquent
 */
class Issue extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'title',
        'status_id',
    ];

    /* @var int $perPage 分頁時的每頁數量 */
    protected $perPage = 20;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function labels()
    {
        return $this->hasMany(Label::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
