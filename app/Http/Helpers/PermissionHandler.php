<?php

namespace App\Http\Helpers;

use App\Exceptions\PermissionException;

class PermissionHandler
{
    public static function exists(array $credentials, string $key): bool
    {

        if (in_array($key, $credentials)) {

            return true;
        } else {

            throw new PermissionException("user-permission-error");
        }
    }
}
