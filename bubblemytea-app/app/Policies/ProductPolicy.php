<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine whether the user can store models.
     */
    public function store(User $user): Response
    {
        {
            return $user->role === 'admin'
                    ? Response::allow()
                    : Response::deny('You have to be admin to do that!');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): Response
    {
        return $user->role === 'admin'
                ? Response::allow()
                : Response::deny('You have to be admin to do that!');
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    /* public function restore(User $user, Product $product): bool
    {
        //
    } */

    /**
     * Determine whether the user can permanently delete the model.
     */
    /* public function forceDelete(User $user, Product $product): bool
    {
        //
    } */
}
