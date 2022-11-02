<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, User $target)
    {
        return $user->can('update_roles') && $target->roles->isEmpty() || $user->highestRole()?->subordinates()?->contains($target->highestRole());
    }

    public function delete(User $user, User $target)
    {
        return $target->canBeDeleted()
            && $user->can('delete_roles') && ($target->roles->isEmpty() || $user->highestRole()?->subordinates()?->contains($target->highestRole()));
    }
}
