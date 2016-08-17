<?php

namespace IssueTracker;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * 狀態改變紀錄
 *
 * @property-read int id
 * @property int issue_id
 * @property int user_id
 * @property string target_type
 * @property int target_id
 *
 * @property-read Issue issue
 * @property-read User user
 * @property-read Status|User|Label target
 *
 *
 * @property \Carbon\Carbon|null created_at
 * @property \Carbon\Carbon|null updated_at
 * @mixin \Eloquent
 */
class History extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'issue_id',
        'user_id',
        'target_type',
        'target_id',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->morphTo();
    }
}
