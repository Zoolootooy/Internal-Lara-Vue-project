<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class Snippet extends BaseModel
{
    use CreatedByTrait;

    const LOCATION_NONE = 0;
    const LOCATION_HEADER = 1;
    const LOCATION_FOOTER = 2;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'content',
        'visible',
        'location',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'location' => 'integer',
        'visible' => 'boolean',
        'created_by' => 'integer',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'visible' => true,
        'location' => self::LOCATION_NONE,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'name',
        'slug',
        'content',
    ];

    /**
     * @return array
     */
    public static function locations()
    {
        return [
            self::LOCATION_NONE => __('None'),
            self::LOCATION_HEADER => __('Header'),
            self::LOCATION_FOOTER => __('Footer'),
        ];
    }

    /**
     * @return array
     */
    public static function locationBadgeClasses()
    {
        return [
            self::LOCATION_NONE => 'warning',
            self::LOCATION_HEADER => 'success',
            self::LOCATION_FOOTER => 'info',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'snippet_pages', 'snippet_id', 'page_id');
    }

    /**
     * @param $page_id
     * @return bool
     */
    public function hasPage($page_id)
    {
        return null !== $this->pages->where('page_id', $page_id)->first();
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
    public function getLocationTextAttribute()
    {
        return $this->locations()[$this->location] ?? null;
    }

    /**
     * @return mixed
     */
    public function getLocationBadgeClassAttribute()
    {
        return static::locationBadgeClasses()[$this->location] ?? null;
    }
}
