<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy extends PolicyBase
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

    public function moderationAnime(User $user)
    {
        if ($this->checkPermission($user, 'anime.moderation')) {
            return true;
        }

        return false;
    }
}
