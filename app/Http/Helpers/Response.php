<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

class Response
{
    public static function send(int $code, bool $status, string $messageCode, $data = []): JsonResponse
    {
        return response()->json([
            "status" => $status,
            "messageCode" => $messageCode,
            "list" => $data,
        ], $code);
    }
}
