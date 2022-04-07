<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Request;

class RegisterController
{
    public function view(Request $request)
    {
        return view('Auth/Registration/registration');
    }

    public function callBack(RegistrationRequest $request)
    {
        return $request->validationData();
    }
}
