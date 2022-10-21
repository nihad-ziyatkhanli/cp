<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Role;

class RolePolicy
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

    public function update(User $user, Role $role)
    {
        return $user->can('update_roles') && $user->highestRole()?->subordinates()?->contains($role);
    }

    public function delete(User $user, Role $role)
    {
       return $user->can('delete_roles') && $user->highestRole()?->subordinates()?->contains($role);
    }
}
