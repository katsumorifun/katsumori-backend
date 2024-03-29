<?php

namespace App\Repositories;

use App\Contracts\Repository\UserRepository;
use App\Models\User as UserModel;
use App\Support\Enums\Group;
use Carbon\Carbon;

class UserEquivalentRepository extends RepositoryEquivalent implements UserRepository
{
    public function __construct()
    {
        $this->model = UserModel::class;
    }

    /**
     * @param  string  $name
     * @param  string  $email
     * @param  string  $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createOrGetUser(string $name, string $email, string $password, null|string $timestamp = 'Europe/Moscow'): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        $user = $this
            ->getBuilder()
            ->create([
                'name'      => $name,
                'email'     => $email,
                'password'  => bcrypt($password),
                'timestamp' => $timestamp ?: 'Europe/Moscow',
            ]);

        $user->setGroup(Group::GUEST_GROUP_ID);

        return $user;
    }

    /**
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function getByName(string $name): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
    {
        return $this
            ->getBuilder()
            ->firstWhere(['name', '=', $name]);
    }

    /**
     * @param  string  $email
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function getByEmail(string $email): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
    {
        return $this
            ->getBuilder()
            ->firstWhere('email', '=', $email);
    }

    public function setEmailVerifiedNow(int $user_id)
    {
        $user = $this
            ->getBuilder()
            ->find($user_id);

        $user->email_verified_at = now();
        $user->save();
    }

    /**
     * Удаление старых пользователей без подтвержденной почты.
     *
     * @param  int  $days По умолчанию 1 день
     */
    public function removeUsersUnconfirmedEmail(int $days = 1)
    {
        $this
            ->getBuilder()
            ->where('created_at', '<', now()->subDays($days))
            ->where('email_verified_at', '=', null)
            ->delete();
    }

    public function updateStatusAvatar(int $user_id, bool $status = true)
    {
        $user = $this
            ->getBuilder()
            ->find($user_id);

        $user->update(['custom_avatar' => $status]);
    }

    public function getCustomAvatarStatus($user_id): bool
    {
        $user = $this
            ->getBuilder()
            ->find($user_id, ['id', 'custom_avatar']);

        return $user->custom_avatar;
    }

    public function updateMinimizedAvatars(int $user_id, string $extension)
    {
        $user = $this
            ->getBuilder()
            ->find($user_id);

        $user->avatar_x32 = '/x32/'.$user->id.'_'.$user->name.'.'.$extension;
        $user->avatar_x64 = '/x64/'.$user->id.'_'.$user->name.'.'.$extension;
        $user->avatar_x128 = '/x128/'.$user->id.'_'.$user->name.'.'.$extension;

        $user->update();
    }

    public function getUserProfile(int $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return $this->getBuilder()->find($id);
    }

    /**
     * Смена группы guest у пользователей с датой гергистрации выше days на группу user.
     *
     * @param  int  $dayAgo
     * @return void
     */
    public function changeUserGroupToUsers(int $days = 2)
    {
        $guests = $this->getBuilder()
            ->where('group_id', Group::GUEST_GROUP_ID)
            ->get();

        $guests->each(function ($user) use ($days) {
            if ($user->hasVerifiedEmail()) {
                $dayToCheck = Carbon::parse($user->created_at)->addDays($days);

                if ($user->email_verified_at > $dayToCheck) {
                    $user->setGroup(Group::USER_GROUP_ID);
                    $user->update();
                }
            }

        });
    }
}
