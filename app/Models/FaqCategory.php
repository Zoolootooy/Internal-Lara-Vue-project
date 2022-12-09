<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class FaqCategory extends BaseModel
{
    use CreatedByTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'keywords',
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
        'keywords',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(FaqItem::class, 'parent_id');
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
