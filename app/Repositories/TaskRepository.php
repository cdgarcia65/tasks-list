<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get all of the completed tasks for a given user.
     *
     * @param  User $user
     * @return Collection
     */
    public function completedForUser(User $user)
    {
        return $user->tasks()
            ->today()
            ->onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();
    }
}
