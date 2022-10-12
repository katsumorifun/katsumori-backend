<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends PolicyBase
{
    use HandlesAuthorization;

    public function edit(User $user)
    {
        if (Auth()->user()->id != $user->id) {
            return $this->checkPermission($user, 'users.admin.edit');
        }

        if (Auth()->user()->id == $user->id) {
            return $this->checkPermission($user, 'users.edit');
        }

        return false;
    }
}
