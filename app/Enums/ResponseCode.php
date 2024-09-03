<?php

namespace App\Enums;

enum ResponseCode: int {
    case Ok = 200;
    case BadRequest = 400;
    case Forbideen = 403;
    case NotFound = 404;
    case ValidationError = 422;
    case InternalError = 500;
}
