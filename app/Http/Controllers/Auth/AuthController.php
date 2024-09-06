<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\Login;
use App\Services\AuthService;
use Exception;

class AuthController extends Controller
{

    private readonly AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(AuthRequest $request)
    {
        try {

            $loginData = $this->authService->loginService($request->email, $request->senha);

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'login-success', $loginData);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'login-error');
        }
    }
    public function logout()
    {
        try {

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'logout-success');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'logout-error', $e->getMessage());
        }
    }

}
