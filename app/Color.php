<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 顏色
 *
 * @property-read int id
 * @property string name
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

}
