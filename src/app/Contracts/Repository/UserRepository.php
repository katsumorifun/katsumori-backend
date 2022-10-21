<?php

namespace App\Contracts\Repository;

interface UserRepository
{
    public function createOrGetUser(string $name, string $email, string $password);

    public function getByName(string $name);

    public function getByEmail(string $email);

    public function setEmailVerifiedNow(int $user_id);

    public function removeUsersUnconfirmedEmail(int $days = 1);

    public function updateAvatar(int $user_id, string $avatar_path);

    public function updateMinimizedAvatars(int $user_id, string $extension);

    public function getUserProfile(int $id);

    public function changeUserGroupToUsers(int $days = 2);

}