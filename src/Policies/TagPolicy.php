<?php

namespace Hooraweb\LaravelApi\Policies;

use User;
Use Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tags.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('manage-tags');
    }

    /**
     * Determine whether the user can view the tag.
     *
     * @param  User  $user
     * @param  Tag  $tag
     * @return mixed
     */
    public function view(User $user, Tag $tag)
    {
        return $user->hasPermissionTo('manage-tags');
    }

    /**
     * Determine whether the user can create tags.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('manage-tags');
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param  User  $user
     * @param  Tag  $tag
     * @return mixed
     */
    public function update(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param  User  $user
     * @param  Tag  $tag
     * @return mixed
     */
    public function delete(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can restore the tag.
     *
     * @param  User  $user
     * @param  Tag  $tag
     * @return mixed
     */
    public function restore(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tag.
     *
     * @param  User  $user
     * @param  Tag  $tag
     * @return mixed
     */
    public function forceDelete(User $user, Tag $tag)
    {
        //
    }
}
