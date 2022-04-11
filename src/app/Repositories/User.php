<?php

namespace App\Repositories;

use \App\Models\User as UserModel;

class User extends Repository
{
    public function __construct()
    {
        $this->model = UserModel::class;
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createOrGetUser($name, $email, $password): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        return $this->getBuilder()->create([
            'name'    => $name,
            'email'   => $email,
            'password'=> bcrypt($password),
        ]);
    }

    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getByName($name): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->findBy(['name', '=', $name]);
    }

    public function setEmailVerifiedNow($user_id)
    {
        $user = $this->getBuilder()->find($user_id);

        $user->email_verified_at = now();
        $user->save();
    }
}
