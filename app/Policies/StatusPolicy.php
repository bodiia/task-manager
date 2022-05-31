<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return auth()->check();
    }

    public function delete(User $user, Status $status)
    {
        return $status->creator()->is($user);
    }
}
