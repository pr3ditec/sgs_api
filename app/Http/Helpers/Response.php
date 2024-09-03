<?php

namespace App\Http\Helpers;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use Illuminate\Http\JsonResponse;

class Response
{
    public static function send(ResponseCode $code, ResponseStatus $status, string $messageCode, $data = []): JsonResponse
    {
        return response()->json([
            "status" => (bool) $status->value,
            "messageCode" => $messageCode,
            "list" => $data,
        ], $code->value);
    }
}
