<?php

namespace App\Policies;

use App\Models\Charity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $requesting_user): bool
    {
        return $requesting_user->role == 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $requesting_user, User $requested_user): bool
    {
        return $requesting_user->role == 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $requesting_user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $requesting_user, User $requested_user): bool
    {
        return $requesting_user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $requesting_user, User $requested_user): bool
    {
        return $requesting_user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $requesting_user, User $requested_user): bool
    {
        return $requesting_user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $requesting_user, User $requested_user): bool
    {
        return $requesting_user->role == 'admin';
    }
}
