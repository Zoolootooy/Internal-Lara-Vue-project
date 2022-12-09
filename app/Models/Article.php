<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class Article extends BaseModel
{
    use CreatedByTrait;

    const VISIBLE_NO = 0;
    const VISIBLE_YES = 1;
    const VISIBLE_LOGGED = 2;
    const VISIBLE_GUEST = 3;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'short_description',
        'description',
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
    protected $files = [
        'image' => 'image',
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

    /**
     * @return mixed
     */
    public function getVisibleTextAttribute()
    {
        $visible = $this->getAttribute('visible');

        return static::visibleStatuses()[$visible] ?? null;
    }

    /**
     * @return mixed
     */
    public function getVisibleBadgeClassAttribute()
    {
        $visible = $this->getAttribute('visible');

        return static::visibleBadgeClasses()[$visible] ?? null;
    }
}
