<?php

namespace App\Traits;

use Auth;
use App\Models\MenuItem;
use App\Models\Page;

/**
 * Trait MenuItemTrait
 * @package App\Presenters
 */
trait MenuItemTrait
{
    /**
     * @return string
     */
    public function getItemPaddingAttribute()
    {
        return str_repeat('&nbsp;', $this->depth * 4);
    }

    /**
     * @return string
     */
    public function getItemClassAttribute()
    {
        return $this->getAttribute('children')->count() ? 'dropdown' : '';
    }

    /**
     * @return mixed
     */
    public function getItemUrlAttribute()
    {
        return $this->urlPrefix
            . ($this->getType() == MenuItem::TYPE_PAGE && !empty($this->getPage())
                ? $this->page->slug
                : $this->url);
    }

    /**
     * @return bool
     */
    public function getItemVisibleAttribute()
    {
        $page = $this->getPage();

        if (empty($page)) {
            return true;
        }

        $visible = (int) $page->getAttribute('visible');

        return (empty($page)
            || $visible == Page::VISIBLE_YES
            || Auth::check() && $visible == Page::VISIBLE_LOGGED
            || !Auth::check() && $visible == Page::VISIBLE_GUEST);
    }

    /**
     * @return null
     */
    private function getPage()
    {
        return $this->page ?? null;
    }

    /**
     * @return null
     */
    private function getType()
    {
        return $this->type ?? null;
    }

    /**
     * @return string
     */
    public function getUrlPrefixAttribute()
    {
        return request()->is('/') ? '' : '/';
    }

    /**
     * @return array
     */
    public static function listWithPadding()
    {
        $list = [];
        $models = static::defaultOrder()->withDepth()->get();

        foreach ($models as $model) {
            $list[str_repeat('-', $model->depth * 2) . $model->link_name] = $model->id;
        }

        return $list;
    }
}