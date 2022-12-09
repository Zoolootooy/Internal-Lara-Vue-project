<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class Quote extends BaseModel
{
    use CreatedByTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'visible',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
        'sorting' => 'integer',
        'created_by' => 'integer',
    ];

    /**
     * @var array
     */
    protected $order = [
        'created_at' => 'desc',
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
        'visible' => true,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'name',
        'description',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }
}
