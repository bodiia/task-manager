<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return auth()->check();
    }

    public function delete(User $user, Label $label)
    {
        return auth()->check();
    }
}
