<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create()
    {
        return auth()->check();
    }

    public function update(User $user, Task $task)
    {
        return $task->author()->is($user) || $task->executor()->is($user);
    }

    public function delete(User $user, Task $task)
    {
        return $task->author()->is($user);
    }
}
