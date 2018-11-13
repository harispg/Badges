<?php

namespace App\Policies;

use App\User;
use App\Badge;
use Illuminate\Auth\Access\HandlesAuthorization;

class BadgesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the badge.
     *
     * @param  \App\User  $user
     * @param  \App\Badge  $badge
     * @return mixed
     */
    public function view(User $user, Badge $badge)
    {
        return $user->id === $badge->user_id;
    }

    /**
     * Determine whether the user can create badges.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the badge.
     *
     * @param  \App\User  $user
     * @param  \App\Badge  $badge
     * @return mixed
     */
    public function update(User $user, Badge $badge)
    {
        //
    }

    /**
     * Determine whether the user can delete the badge.
     *
     * @param  \App\User  $user
     * @param  \App\Badge  $badge
     * @return mixed
     */
    public function delete(User $user, Badge $badge)
    {
        //
    }

    /**
     * Determine whether the user can restore the badge.
     *
     * @param  \App\User  $user
     * @param  \App\Badge  $badge
     * @return mixed
     */
    public function restore(User $user, Badge $badge)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the badge.
     *
     * @param  \App\User  $user
     * @param  \App\Badge  $badge
     * @return mixed
     */
    public function forceDelete(User $user, Badge $badge)
    {
        //
    }
}
