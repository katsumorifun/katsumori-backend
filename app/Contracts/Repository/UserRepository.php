<?php

namespace App\Contracts\Repository;

interface UserRepository
{
    public function createOrGetUser(string $name, string $email, string $password, null|string $timestamp = 'Europe/Moscow');

    public function getByName(string $name);

    public function getByEmail(string $email);

    public function setEmailVerifiedNow(int $user_id);

    public function removeUsersUnconfirmedEmail(int $days = 1);

    public function updateStatusAvatar(int $user_id, bool $status = true);

    public function getCustomAvatarStatus($user_id): bool;

    public function updateMinimizedAvatars(int $user_id, string $extension);

    public function getUserProfile(int $id);

    public function changeUserGroupToUsers(int $days = 2);
}
