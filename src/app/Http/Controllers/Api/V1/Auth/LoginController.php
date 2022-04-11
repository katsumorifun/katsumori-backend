<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\Auth;

class LoginController
{
    protected Auth $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function callback()
    {
        $this->auth->login('email', 'password');
    }
}
