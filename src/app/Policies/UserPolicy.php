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

            if ($this->checkPermission($user, 'user.admin.edit')) {
                return true;
            }

            return false;
        }

        if (Auth()->user()->id = $user->id && $this->checkPermission($user, 'user.edit')) {
            return true;
        }

        return false;
    }
}
