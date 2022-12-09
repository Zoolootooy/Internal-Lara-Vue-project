<?php
namespace App\Traits;

use App\Observers\DemoObserver;

trait DemoTrait
{
    /**
     * Attaches observer to the model
     *
     * return null
     */
    public static function bootDemoTrait()
    {
        static::observe(new DemoObserver);
    }
}