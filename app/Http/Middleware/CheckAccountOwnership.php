<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccountOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $accountId = $request->route('id');
        $authenticatedUserId = auth()->id();

        // Check if the authenticated user's ID matches the account ID
        if ($accountId != $authenticatedUserId) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
