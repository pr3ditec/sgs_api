<?php

namespace App\Http\Helpers;

use App\Exceptions\PermissionException;

class PermissionHandler
{
    public static function exists(string $key): bool
    {
        $credentials = Session::getByKey('credentials');

        if (in_array($key, $credentials)) {

            return true;
        } else {

            throw new PermissionException("user-permission-error");
        }
    }
}
