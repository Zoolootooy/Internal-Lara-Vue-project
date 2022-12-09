<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page.
     *
     * @param  User  $user
     * @param  Country  $country
     * @return mixed
     */
    public function view(User $user, Country $country)
    {
        return true;
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  User  $user
     * @param  Country  $country
     * @return mixed
     */
    public function update(User $user, Country $country)
    {
        return true;
    }
}
