<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FoodFile;
use Illuminate\Auth\Access\Response;

class FoodFilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FoodFile $foodFile)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FoodFile $foodFile)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FoodFile $foodFile)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FoodFile $foodFile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FoodFile $foodFile)
    {
        //
    }
}
