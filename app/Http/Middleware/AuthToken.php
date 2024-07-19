<?php

namespace App\Http\Middleware;

use App\Http\Helpers\PermissionHandler;
use App\Http\Helpers\Response as HelpersResponse;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken();
            $token_payload = $token->getPayload();

            PermissionHandler::exists($token_payload->get('credentials'), $request->route()->getName());

            return $next($request);
        } catch (JWTException $e) {

            return HelpersResponse::send(402, false, "token-not-authorized");
        } catch (Exception $e) {

            return HelpersResponse::send(400, false, "authroziation-token-error", $e->getMessage());
        }

    }
}
