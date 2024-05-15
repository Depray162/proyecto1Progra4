<?php

namespace App\Http\Middleware;

use App\Helpers\JwtAuth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddlewareVerifyPac
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
        $logged = $jwt->verifyTokenMed($token, true);

        if (!is_bool($logged) && $logged->tipo == 'medico') {
            return $next($request);
        }

        $logged = $jwt->verifyTokenPac($token, true);

        if (!is_bool($logged) && $logged->iss == $request->route('id')) {
            return $next($request);
        } else {
            $response = [
                "status" => 400,
                "message" => "No tiene autorizacion pac",
            ];
            return response()->json($response, 400);
        }
    }
}
