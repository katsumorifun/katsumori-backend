<?php

namespace App\Repositories;

use App\Models\Role;
use \App\Models\User as UserModel;
use Carbon\Carbon;

class User extends Repository
{
    public function __construct()
    {
        $this->model = UserModel::class;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createOrGetUser(string $name, string $email, string $password): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        $role = Role::where(['en_name' => 'guest'])->first();

        $user = $this
            ->getBuilder()
            ->create([
                'name'    => $name,
                'email'   => $email,
                'password'=> bcrypt($password),
                ]);

        $user->roles()->attach($role);

        return $user;
    }

    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
     */
    public function getByName(string $name): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null
    {
        return $this
            ->getBuilder()
            ->firstWhere(['name', '=', $name]);
    }

    /**
     * @param string $email
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
     * Удаление старых пользователей без подтвержденной почты
     *
     * @param int $days По умолчанию 1 день
     */
    public function removeUsersUnconfirmedEmail(int $days = 1)
    {
        $this
            ->getBuilder()
            ->where('created_at', '<', now()->subDays($days))
            ->where('email_verified_at', '=', null)
            ->delete();
    }

    public function updateAvatar(int $user_id, string $avatar_path)
    {
        $user = $this
            ->getBuilder()
            ->find($user_id);

        $user->update(['avatar' => $avatar_path]);
    }

    public function updateMinimizedAvatars(int $user_id, string $extension)
    {
        $user = $this
            ->getBuilder()
            ->find($user_id);

        $user->avatar_x32 = '/x32/' . $user->id . '_' . $user->name . '.' . $extension;
        $user->avatar_x64 = '/x64/' . $user->id . '_' . $user->name . '.' . $extension;
        $user->avatar_x128 = '/x128/' . $user->id . '_' . $user->name . '.' . $extension;

        $user->update();
    }

    public function getUserProfile(int $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return $this->getBuilder()->with('roles')->find($id);
    }

    /**
     * Смена группы guest у пользователей с датой гергистрации выше days на группу user
     *
     * @param int $dayAgo
     * @return void
     */
    public function changeUserGroupToUsers(int $days = 2)
    {
        $role = Role::where(['en_name' => 'user'])->first();

        $guests = $this->getBuilder()
            ->whereHas('roles', function ($query) {
                $query->where(['en_name' => 'guest']);
            })
            ->get();

        $guests->each(function ($user) use ($role, $days) {
            if ($user->hasVerifiedEmail()) {
                $dayToCheck = Carbon::parse($user->created_at)->addDays($days);

                if ($user->email_verified_at > $dayToCheck) {
                    $user->roles()->attach($role);
                }
            }

        });
    }
}
