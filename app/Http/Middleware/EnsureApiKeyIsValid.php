<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKeyIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $api_key = $request->header('Authorization');

        if (empty($api_key)
            || ! str_starts_with($api_key, 'Api-Key ')) {
            return response()->json(['message' => 'API key missing or malformed'], 401);
        }

        $token = trim(substr($api_key, 8));

        $user = AccessToken::getUser($token);

        if (empty($user)) {
            return response()->json(['message' => 'Invalid API key'], 401);
        }

        auth()->setUser($user);

        return $next($request);
    }
}
