<?php

namespace App\Base\Auth;

use App\Base\Auth\Exceptions\HashException;
use \App\Models\User;
use \App\Repositories\VerifyEmail as VerifyRepository;

class VerifyEmail
{

    protected string $hash;

    /**
     * @param string $user_name
     * @return string
     */
    protected function generateHash(string $user_name): string
    {
        return $this->hash = md5(rand(4, 47) . $user_name . date('D, d M Y H:i:s') . rand(8, 35));
    }

    /**
     * @param int $user_id
     * @param string $user_name
     */
    public function send(int $user_id, string $user_name)
    {
        $hash = $this->generateHash($user_name);

        (new VerifyRepository)->create($user_id, $hash);

        $url = route('verification.verify', ['user_id' => $user_id, 'hash' => $hash]);

        User::find($user_id)->notify(new \App\Notifications\VerifyEmail($url));
    }

    /**
     * @param int $user_id
     * @param string $hash
     * @throws HashException
     */
    public function verifyEmail(int $user_id, string $hash)
    {
        $hash = (new VerifyRepository)->getHashAndUser($user_id, $hash);

        if (empty($hash) || $hash->user_id != $user_id) {
            throw new HashException();
        }

        (new \App\Repositories\User())->setEmailVerifiedNow($user_id);

        $hash->delete();
    }

}
