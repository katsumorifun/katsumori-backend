<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\OperationError;

class VerifyEmail
{
    public function check(int $user_id, string $hash) {

        if (empty($user_id) || empty($hash)) {
            return view('auth.email.success', ['status' => false]);
        }

        try {
            /**
             * @var \App\Contracts\Auth\VerifyEmail $email
             */
            $email = app('app.auth.email');
            $email->verifyEmail($user_id, $hash);

        } catch (OperationError $ex) {
            return view('auth.email.confirm', ['status' => false]);
        }

        return view('auth.email.confirm', ['status' => true]);
    }
}
