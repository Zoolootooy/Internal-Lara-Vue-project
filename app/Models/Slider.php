<?php

namespace App\Models;

use App\Traits\CreatedByTrait;
use App\Traits\TypeTrait;

class Slider extends BaseModel
{
    use CreatedByTrait;
    use TypeTrait;

    const TYPE_IMAGE = 0;
    const TYPE_VIDEO = 1;

    const POSITION_LEFT = 0;
    const POSITION_CENTER = 1;
    const POSITION_RIGHT = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'video_url',
        'forward_url',
        'type',
        'visible',
        'position',
        'button_caption',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
        'position' => 'integer',
        'sorting' => 'integer',
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
        'type' => self::TYPE_IMAGE,
        'visible' => true,
        'position' => self::POSITION_LEFT,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'name',
        'description',
        'video_url',
        'forward_url',
        'button_caption',
    ];

    /**
     * @return array
     */
    public static function positions()
    {
        return [
            self::POSITION_LEFT => __('Left'),
            self::POSITION_CENTER => __('Center'),
            self::POSITION_RIGHT => __('Right'),
        ];
    }

    /**
     * @return array
     */
    public static function positionBadgeClasses()
    {
        return [
            self::POSITION_LEFT => 'info',
            self::POSITION_CENTER => 'warning',
            self::POSITION_RIGHT => 'success',
        ];
    }

    /**
     * @return array
     */
    public static function types()
    {
        return [
            self::TYPE_IMAGE => __('Image Slide'),
            self::TYPE_VIDEO => __('Video Slide'),
        ];
    }

    /**
     * @return array
     */
    public static function typeBadgeClasses()
    {
        return [
            self::TYPE_IMAGE => 'success',
            self::TYPE_VIDEO => 'info',
        ];
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    /**
     * @return mixed
     */
    public function getPositionTextAttribute()
    {
        return $this->positions()[$this->position] ?? null;
    }

    /**
     * @return mixed
     */
    public function getPositionBadgeClassAttribute()
    {
        return static::positionBadgeClasses()[$this->position] ?? null;
    }

    /**
     * @return mixed
     */
    public static function firstRecord()
    {
        return static::visible()
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
