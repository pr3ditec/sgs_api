<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;

class AuthCheckController extends Controller
{

    public function check()
    {
        return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'check-success');
    }

}
