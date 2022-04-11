<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\VerifyEmail;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\User;
use Illuminate\Support\Facades\Request;

class RegistrationController
{
    public function view(Request $request)
    {
        return view('auth/registration/registration');
    }

    public function callBack(RegistrationRequest $request)
    {
        //Создание нового пользователя
       $user = app(User::class)->createOrGetUser($request->get('name'), $request->get('email'), $request->get('password'));

        //Отправка сообщения с подтверждением регистрации
       app(VerifyEmail::class)->send($user->id, $user->name);
    }
}
