<?php

namespace Hooraweb\LaravelApi\Policies;

use User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('manage-users');
    }

}
