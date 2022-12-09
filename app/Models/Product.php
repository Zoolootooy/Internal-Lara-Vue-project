<?php

namespace App\Models;

use App\Traits\CreatedByTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CreatedByTrait;

    const VISIBLE_NO = 0;
    const VISIBLE_YES = 1;
    const VISIBLE_LOGGED = 2;
    const VISIBLE_GUEST = 3;

    protected $fillable = [
        'name',
        'type',
        'price',
        'created_by',
        'visible',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'visible' => self::VISIBLE_YES,
    ];

    /**
     * @return array
     */
    public static function visibleStatuses()
    {
        return [
            self::VISIBLE_NO => __('No'),
            self::VISIBLE_YES => __('Yes'),
            self::VISIBLE_LOGGED => __('Logged'),
            self::VISIBLE_GUEST => __('Guest'),
        ];
    }

    /**
     * @return array
     */
    public static function visibleBadgeClasses()
    {
        return [
            self::VISIBLE_NO => 'danger',
            self::VISIBLE_YES => 'success',
            self::VISIBLE_LOGGED => 'warning',
            self::VISIBLE_GUEST => 'warning',
        ];
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', self::VISIBLE_YES);
    }
}
