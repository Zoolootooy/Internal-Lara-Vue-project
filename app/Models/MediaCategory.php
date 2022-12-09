<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class MediaCategory extends BaseModel
{
    use CreatedByTrait;

    const CATEGORY_IMAGE = 1;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
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
    protected $attributes = [
        'visible' => true,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'name',
        'slug',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(MediaFile::class, 'parent_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }
}
