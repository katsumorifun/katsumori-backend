<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Base\Auth\Auth;
use App\Http\Controllers\Api\ApiController;

class LoginController extends ApiController
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
