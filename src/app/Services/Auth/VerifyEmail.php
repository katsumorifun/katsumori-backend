<?php

namespace App\Services\Auth;

use App\Contracts\Auth\VerifyEmail as VerifyEmailContract;
use App\Exceptions\OperationError;
use App\Models\User;
use App\Repositories\User as UserRepository;
use App\Repositories\VerifyEmail as VerifyRepository;

class VerifyEmail implements VerifyEmailContract
{
    protected string $hash;
    protected VerifyRepository $email_verify_repository;
    protected UserRepository $user_repository;
    protected User $user_model;

    public function __construct()
    {
        $this->email_verify_repository = app()->make(VerifyRepository::class);
        $this->user_repository = app()->make(UserRepository::class);
        $this->user_model = app()->make(User::class);
    }

    /**
     * @param  string  $user_name
     * @return string
     */
    protected function generateHash(string $user_name): string
    {
        return $this->hash = md5(rand(4, 47).$user_name.date('D, d M Y H:i:s').rand(8, 35));
    }

    public function send(int $user_id, string $user_name)
    {
        $hash = $this->generateHash($user_name);

        $this->email_verify_repository->createHash($user_id, $hash);

        $url = route('verification.verify', ['user_id' => $user_id, 'hash' => $hash]);

        $this->user_model::find($user_id)->notify(new \App\Notifications\VerifyEmail($url));
    }

    /**
     * @param  int  $user_id
     * @param  string  $hash
     *
     * @throws OperationError
     */
    public function verifyEmail(int $user_id, string $hash)
    {
        $hash = $this->email_verify_repository->getHash($user_id, $hash);

        if (empty($hash) || $hash->user_id != $user_id) {
            throw new OperationError('hash error');
        }

        $this->user_repository->setEmailVerifiedNow($user_id);

        $hash->delete();
    }
}
