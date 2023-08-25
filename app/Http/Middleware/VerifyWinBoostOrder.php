<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\WinBoostOrder;

class VerifyWinBoostOrder 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $orderId = $request->route('id');
    
        $boostOrder = WinBoostOrder::findOrFail($orderId);
    
        // Check if the authenticated user ID matches the boost order's user_id
        if ($boostOrder->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
    
        // Check if the boost order's payment status is fulfilled
        if ($boostOrder->payment_status === 1) {
            abort(403, 'This order is paid');
        }
    
        return $next($request);
    }
}
