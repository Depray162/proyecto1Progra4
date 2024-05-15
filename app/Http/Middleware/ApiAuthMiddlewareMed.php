<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\JwtAuth;

class ApiAuthMiddlewareMed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jwt = new JwtAuth();
        $token = $request->bearerToken();
        $logged = $jwt->verifyTokenMed($token);

        if ($logged) {
            return $next($request);
        } else {
            $response = array(
                'message' => 'No tiene la autorización para acceder med',
                'status' => 401,
            );
            return response()->json($response, 401);
        }
    }
}
