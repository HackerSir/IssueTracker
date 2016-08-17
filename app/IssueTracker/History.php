<?php

namespace IssueTracker;

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
 * @property-read \IssueTracker\Issue|null issue
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
}
