<?php

namespace Hooraweb\LaravelApi\Policies;

use User;
use Taxonomy;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxonomyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any taxonomies.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the taxonomy.
     *
     * @param  User  $user
     * @param  Taxonomy  $taxonomy
     * @return mixed
     */
    public function view(User $user, Taxonomy $taxonomy)
    {
        return true;
        //
    }

    /**
     * Determine whether the user can create taxonomies.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //

        return true;
    }

    /**
     * Determine whether the user can update the taxonomy.
     *
     * @param  User  $user
     * @param  Taxonomy  $taxonomy
     * @return mixed
     */
    public function update(User $user, Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Determine whether the user can delete the taxonomy.
     *
     * @param  User  $user
     * @param  Taxonomy  $taxonomy
     * @return mixed
     */
    public function delete(User $user, Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Determine whether the user can restore the taxonomy.
     *
     * @param  User  $user
     * @param  Taxonomy  $taxonomy
     * @return mixed
     */
    public function restore(User $user, Taxonomy $taxonomy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the taxonomy.
     *
     * @param  User  $user
     * @param  Taxonomy  $taxonomy
     * @return mixed
     */
    public function forceDelete(User $user, Taxonomy $taxonomy)
    {
        //
    }
}
