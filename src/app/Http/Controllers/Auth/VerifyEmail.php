<?php

namespace App\Http\Controllers\Auth;

use App\Base\Auth\Exceptions\HashException;

class VerifyEmail
{
    public function check(int $user_id, string $hash){

        if (empty($user_id) || empty($hash)) {
            return view('auth.email.success', ['status' => false]);
        }

        try {
            app(\App\Base\Auth\VerifyEmail::class)->verifyEmail($user_id, $hash);

        } catch (HashException $ex) {
            return view('auth.email.confirm', ['status' => false]);
        }

        return view('auth.email.confirm', ['status' => true]);
    }
}
