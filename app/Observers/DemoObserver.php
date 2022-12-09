<?php

namespace App\Observers;

use Auth;
use Exception;
use App\Models\Role;

class DemoObserver
{
    /**
     * @param \Closure|string $callback
     * @return bool
     * @throws \Exception
     */
    public static function creating($callback)
    {
        return static::checkPermission();
    }

    /**
     * @param \Closure|string $callback
     * @return bool
     * @throws \Exception
     */
    public static function updating($callback)
    {
        return static::checkPermission();
    }

    /**
     * @param \Closure|string $callback
     * @return bool
     * @throws \Exception
     */
    public static function deleting($callback)
    {
        return static::checkPermission();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public static function checkPermission()
    {
        $hasPermission = static::checkUserPermission();

        if (!$hasPermission) {
            if (request()->is('nova*')) {
                throw new Exception(static::getErrorMessage());
            } else {
                back()->with('status', static::getErrorMessage());
            }
        }

        return $hasPermission;
    }

    /**
     * @throws \Exception
     */
    public static function checkUserPermission()
    {
        return empty(Auth::user())
            || !Auth::user()->hasRole(Role::ROLE_DEMO_USER);
    }

    /**
     * @return array|null|string
     */
    public static function getErrorMessage()
    {
        return __('You are not allowed to perform this action because you have not been granted the permissions.');
    }
}
