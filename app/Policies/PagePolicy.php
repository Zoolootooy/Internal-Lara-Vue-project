<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function checkPermission(User $user, Page $page)
    {
        return $page->createdBy->is($user);
    }

    /**
     * Determine whether the user can view any mails.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    /*public function viewAny(User $user)
    {
        //
    }*/

    /**
     * Determine whether the user can view the page.
     *
     * @param  User  $user
     * @param  Page  $page
     * @return mixed
     */
    /*public function view(User $user, Page $page)
    {
        //
    }*/

    /**
     * Determine whether the user can create pages.
     *
     * @param  User  $user
     * @return mixed
     */
    /*public function create(User $user)
    {
        //
    }*/

    /**
     * Determine whether the user can update the page.
     *
     * @param  User  $user
     * @param  Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        return $this->checkPermission($user, $page);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  User  $user
     * @param  Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        return $this->checkPermission($user, $page);
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param  User  $user
     * @param  Page  $page
     * @return mixed
     */
    /*public function restore(User $user, Page $page)
    {
        //
    }*/

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param  User  $user
     * @param  Page  $page
     * @return mixed
     */
    /*public function forceDelete(User $user, Page $page)
    {
        //
    }*/
}
