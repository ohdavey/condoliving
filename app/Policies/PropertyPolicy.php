<?php

namespace App\Policies;

use App\User;
use App\Property;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the property.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function view(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can create properties.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the property.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return $property->owner_id == $user->id;
    }

    /**
     * Determine whether the user can delete the property.
     *
     * @param  \App\User  $user
     * @param  \App\Property  $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        //
    }
}
