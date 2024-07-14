<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Response as HelpersResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!DB::table('login')->where('token', '=', $request->header('Authorization'))->exists()) {

            return HelpersResponse::send(401, false, 'not-authorized');
        }

        return $next($request);
    }
}
