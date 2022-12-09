<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Traits\MenuItemTrait;
use App\Traits\CreatedByTrait;
use App\Traits\TypeTrait;

class MenuItem extends BaseModel
{
    use NodeTrait;
    use MenuItemTrait;
    use CreatedByTrait;
    use TypeTrait;

    const TYPE_PAGE = 0;
    const TYPE_LINK = 1;
    const TYPE_TEXT = 2;

    const ORDER_BEFORE = 1;
    const ORDER_AFTER = 2;
    const ORDER_CHILD = 3;

    /**
     * @var string
     */
    public static $title = 'link_name';

    /**
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'page_id',
        'type',
        'link_name',
        'url',
        'inherited',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'menu_id' => 'integer',
        'page_id' => 'integer',
        'type' => 'integer',
        'sorting' => 'integer',
        'inherited' => 'boolean',
        'created_by' => 'integer',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'type' => self::TYPE_PAGE,
        'inherited' => true,
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'link_name',
        'url',
    ];

    /**
     * @var string[]
     */
    protected $only = [
        'link_name',
        'id',
    ];

    /**
     * @return array
     */
    public static function types()
    {
        return [
            self::TYPE_PAGE => __('Page'),
            self::TYPE_LINK => __('Link'),
            self::TYPE_TEXT => __('Text'),
        ];
    }

    /**
     * @return array
     */
    public static function typeBadgeClasses()
    {
        return [
            self::TYPE_PAGE => 'success',
            self::TYPE_LINK => 'info',
            self::TYPE_TEXT => 'warning',
        ];
    }

    /**
     * @return array
     */
    public static function orderTypes()
    {
        return [
            self::ORDER_BEFORE => __('Before'),
            self::ORDER_AFTER => __('After'),
            self::ORDER_CHILD => __('Child'),
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @param $order
     * @param $orderItem
     * @throws \Exception
     */
    public function updateOrder($order, $orderItem)
    {
        $relative = Model::findOrFail($orderItem);

        if ($order == self::ORDER_BEFORE) {
            $this->beforeNode($relative)->save();
        } elseif ($order == self::ORDER_AFTER) {
            $this->afterNode($relative)->save();
        } elseif ($order == self::ORDER_CHILD) {
            $relative->appendNode($this);
        }

        Model::fixTree();
    }

    /**
     * @param $query
     * @param $menuId
     * @return mixed
     */
    public function scopeOfMenu($query, $menuId)
    {
        return $query->where('menu_id', $menuId);
    }

    /**
     * @return array
     */
    public static function list()
    {
        return static::defaultOrder()->withDepth()->pluck(static::$title, 'id')->toArray();
    }
}
