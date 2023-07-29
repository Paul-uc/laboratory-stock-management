<?php

namespace App\Policies;

use App\Models\User;
use App\Models\loanStock;
use Illuminate\Auth\Access\Response;

class LoanStockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        if($user->hasPermissionTo('View Loan Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, loanStock $loanStock): bool
    {
        if($user->hasPermissionTo('View Loan Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasPermissionTo('Create Loan Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, loanStock $loanStock): bool
    {
        if($user->hasPermissionTo('Update Loan Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, loanStock $loanStock): bool
    {
        if($user->hasPermissionTo('Delete Loan Stocks')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, loanStock $loanStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, loanStock $loanStock): bool
    {
        //
        return $user->hasRole(['SuperAdmin']);
    }
}
