<?php

namespace App\Policies;

use App\User;
use App\Lease;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lease.
     *
     * @param  \App\User  $user
     * @param  \App\Lease  $lease
     * @return mixed
     */
    public function view(User $user, Lease $lease)
    {
        //
    }

    /**
     * Determine whether the user can create leases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lease.
     *
     * @param  \App\User  $user
     * @param  \App\Lease  $lease
     * @return mixed
     */
    public function update(User $user, Lease $lease)
    {
        return $lease->creator->id == $user->id;
    }

    /**
     * Determine whether the user can delete the lease.
     *
     * @param  \App\User  $user
     * @param  \App\Lease  $lease
     * @return mixed
     */
    public function delete(User $user, Lease $lease)
    {
        //
    }
}
