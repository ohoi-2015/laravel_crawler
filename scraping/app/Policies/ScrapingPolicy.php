<?php

namespace App\Policies;

use App\Models\Scraping;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScrapingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Scraping $scraping): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function index(User $user, Scraping $scraping): bool
    {
        return $scraping->user()->is($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Scraping $scraping): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Scraping $scraping): bool
    {
        return $this->index($user,$scraping);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Scraping $scraping): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Scraping $scraping): bool
    {
        //
    }
}
