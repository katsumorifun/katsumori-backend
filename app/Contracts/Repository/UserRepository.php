<?php

namespace App\Contracts\Repository;

interface UserRepository
{
    public function createOrGetUser(string $name, string $email, string $password, null|string $timestamp = 'Europe/Moscow'): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|array|null;

    public function getByName(string $name): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|array|null;

    public function getByEmail(string $email): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|array|null;

    public function setEmailVerifiedNow(int $user_id);

    public function removeUsersUnconfirmedEmail(int $days = 1);

    public function updateStatusAvatar(int $user_id, bool $status = true);

    public function getCustomAvatarStatus($user_id): bool;

    public function getUserProfile(int $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null;

    public function changeUserGroupToUsers(int $days = 2);
}
