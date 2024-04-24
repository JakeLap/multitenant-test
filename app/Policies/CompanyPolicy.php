<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        return $user->is_admin || $user->companies->where('id', $company->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Company $company): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create projects for the specific company.
     */
    public function createProjects(User $user, Company $company): bool
    {
        return $user->is_admin || $user->companies->where('id', $company->id)->count() > 0;
    }

    /**
     * Determine whether the user can update projects for the specific company.
     */
    public function updateProjects(User $user, Company $company): bool
    {
        return $user->is_admin || $user->companies->where('id', $company->id)->count() > 0;
    }

    /**
     * Determine whether the user can delete projects for the specific company.
     */
    public function deleteProjects(User $user, Company $company): bool
    {
        return $user->is_admin || $user->companies->where('id', $company->id)->count() > 0;
    }
}
