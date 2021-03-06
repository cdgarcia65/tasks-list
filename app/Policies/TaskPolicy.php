<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determinate if the given user can delete the given task.
     *
     * @param  User $user
     * @param  Task $task
     * @return bool
     */
    public function complete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
