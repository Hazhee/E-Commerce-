<?php

namespace App\Policies;

use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasPermissionTo("view sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubCategory $subCategory): bool
    {
        if ($user->hasPermissionTo("show sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo("create sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubCategory $subCategory): bool
    {
        if ($user->hasPermissionTo("update sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubCategory $subCategory): bool
    {
        if ($user->hasPermissionTo("delete sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubCategory $subCategory): bool
    {
        if ($user->hasPermissionTo("restore sub categories")) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubCategory $subCategory): bool
    {
        if ($user->hasPermissionTo("delete sub categories")) {
            return true;
        }
        return false;
    }
}
