<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOperator
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if (!$user || !$user->isOperator()) {
            abort(403, 'Anda tidak memiliki akses Operator.');
        }
        
        return $next($request);
    }
}
