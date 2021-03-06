<?php

namespace App\Policies;

use App\User;
use App\Community;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the community.
     *
     * @param  \App\User  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function view(User $user, Community $community)
    {
        //
    }

    /**
     * Determine whether the user can create communities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $community->owner_id == $user->id;
    }

    /**
     * Determine whether the user can update the community.
     *
     * @param  \App\User  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function update(User $user, Community $community)
    {
        return $community->owner_id == $user->id;
    }

    /**
     * Determine whether the user can delete the community.
     *
     * @param  \App\User  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function delete(User $user, Community $community)
    {
        //
    }
}
