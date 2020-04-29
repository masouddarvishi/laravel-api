<?php

namespace Hooraweb\LaravelApi\Policies;

use User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any r oles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('manage-roles');
    }

    /**
     * Determine whether the user can view the r ole.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissionTo('manage-roles');
    }

    /**
     * Determine whether the user can create r oles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('manage-roles');
    }

    /**
     * Determine whether the user can update the r ole.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can delete the r ole.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can restore the r ole.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the r ole.
     *
     * @param  User  $user
     * @param  Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
