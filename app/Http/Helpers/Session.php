<?php

namespace App\Http\Helpers;

class Session
{

    public static function store(string $key, mixed $value): void
    {
        session([$key => $value]);
    }

    public static function getByKey(string $key): mixed
    {
        return session($key);
    }

}
