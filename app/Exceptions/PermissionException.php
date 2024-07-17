<?php

namespace App\Exceptions;

use App\Http\Helpers\Response;
use Exception;

class PermissionException extends Exception
{
    public function render($request)
    {
        return Response::send(402, false, 'permission-error');
    }
}
