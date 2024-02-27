<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class WishlistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Wishlist $wishlist): bool
    {
        return $user->currentWishlist()->id == $wishlist->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Wishlist $wishlist): bool
    {
        Log::info('Checking if user can update wishlist, of course we can!');
        return true;

        // Log::info('Checking if user can update wishlist');
        // Log::info('User: ' . $user->id);
        // Log::info('Wishlist: ' . $wishlist->id);
        // Log::info('Session: ' . session()->getId());
        // Log::info('Wishlist session: ' . $wishlist->session_id);

        // if ($wishlist->session_id == session()->getId()) {
        //     return true;
        // }

        // if ($user !== null) {
        //     return $user->id == $wishlist->user_id;
        // }

        // return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Wishlist $wishlist): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Wishlist $wishlist): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Wishlist $wishlist): bool
    {
        return true;
    }
}
