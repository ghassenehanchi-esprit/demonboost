<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ValorantAccount;

class VerifyAccountOrder
{
     /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $accountId = $request->route('id');

    $account = ValorantAccount::findOrFail($accountId);

    // Check if the authenticated user ID matches the boost order's user_id
    if ($account->valorantAccountOrder->user_id !== auth()->user()->id) {
        abort(403, 'Unauthorized');
    }


    return $next($request);
}
}
