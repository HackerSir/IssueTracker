<?php

namespace IssueTracker;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * 回覆
 *
 * @property-read int id
 * @property int author_id
 * @property int issue_id
 * @property string content
 *
 * @property-read Issue issue
 * @property-read User author
 *
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 * @mixin \Eloquent
 */
class Comment extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'author_id',
        'issue_id',
        'content',
    ];

    /* @var int $perPage 分頁時的每頁數量 */
    protected $perPage = 20;

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
