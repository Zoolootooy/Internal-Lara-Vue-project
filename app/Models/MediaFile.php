<?php

namespace App\Models;

use App\Traits\CreatedByTrait;

class MediaFile extends BaseModel
{
    use CreatedByTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'file',
        'visible',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
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
        'file' => 'image',
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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(MediaCategory::class, 'parent_id');
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
     * @param $query
     * @param $parentId
     * @return mixed
     */
    public function scopeOfParent($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    /**
     * @param $parentId
     * @param $itemsPerPage
     * @return mixed
     */
    public static function categoryRecords($parentId, $itemsPerPage)
    {
        return static::with('createdBy')
            ->visible()
            ->ofParent($parentId)
            ->orderBy('created_at', 'desc')
            ->paginate($itemsPerPage);
    }
}
