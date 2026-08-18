<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyN8nApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = config('services.n8n.api_token');

        if (blank($expectedToken) || ! hash_equals($expectedToken, (string) $request->header('X-API-Key'))) {
            abort(401, 'Token de API inválido.');
        }

        return $next($request);
    }
}
