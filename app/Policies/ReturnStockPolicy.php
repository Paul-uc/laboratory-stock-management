<?php

namespace App\Policies;

use App\Models\User;
use App\Models\returnStock;
use Illuminate\Auth\Access\Response;

class ReturnStockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        if($user->hasPermissionTo('View Return Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, returnStock $returnStock): bool
    {
        //
        if($user->hasPermissionTo('View Return Stocks')){
            return true;
        }
        return false;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        if($user->hasPermissionTo('Create Return Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, returnStock $returnStock): bool
    {
        //
        if($user->hasPermissionTo('Update Return Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, returnStock $returnStock): bool
    {
        //
        if($user->hasPermissionTo('Delete Return Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, returnStock $returnStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, returnStock $returnStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    
    }
}
