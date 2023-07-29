<?php

namespace App\Policies;

use App\Models\User;
use App\Models\lossStock;
use Illuminate\Auth\Access\Response;

class LossStockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        if($user->hasPermissionTo('View Loss Stocks')){
            return true;
        }
        return false;
        
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, lossStock $lossStock): bool
    {
        //
        if($user->hasPermissionTo('View Loss Stocks')){
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
        if($user->hasPermissionTo('Create Loss Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, lossStock $lossStock): bool
    {
        //
        if($user->hasPermissionTo('Update Loss Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, lossStock $lossStock): bool
    {
        //
        if($user->hasPermissionTo('Delete Loss Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, lossStock $lossStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, lossStock $lossStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    
    }
}
