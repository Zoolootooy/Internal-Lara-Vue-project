<?php

namespace App\Models;

use App\Traits\CreatedByTrait;
use App\Traits\TypeTrait;

class Menu extends BaseModel
{
    use CreatedByTrait;
    use TypeTrait;

    const TYPE_CUSTOM = 0;
    const TYPE_SYSTEM = 1;

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'type' => self::TYPE_CUSTOM,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'name',
        'slug',
    ];

    /**
     * @return array
     */
    public static function types()
    {
        return [
            self::TYPE_CUSTOM => __('Custom'),
            self::TYPE_SYSTEM => __('System'),
        ];
    }

    /**
     * @return array
     */
    public static function typeBadgeClasses()
    {
        return [
            self::TYPE_CUSTOM => 'info',
            self::TYPE_SYSTEM => 'success',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
