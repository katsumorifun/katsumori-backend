<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimePolicy extends PolicyBase
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user)
    {
        if ($this->checkPermission($user, 'anime.update')) {
            return true;
        }

        return false;
    }
}
