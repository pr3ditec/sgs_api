<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Login\LoginRequest;
use Exception;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {

            return Response::send(200, true, 'login-success');
        } catch (Exception $e) {

            return Response::send(400, false, 'login-failed');
        }
    }
    protected function logout()
    {}

}
