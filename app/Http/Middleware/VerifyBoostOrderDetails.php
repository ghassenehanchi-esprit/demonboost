<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RankBoostOrder;

class VerifyBoostOrderDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $orderId = $request->route('id');
    
        $boostOrder = RankBoostOrder::findOrFail($orderId);
    
        // Check if the authenticated user ID matches the boost order's user_id
        if ($boostOrder->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
    
        // Check if the boost order's payment status is 0 (assuming 0 indicates unpaid)
        if ($boostOrder->payment_status === 0) {
            abort(403, 'Make the payment of the order to access this page');
        }
    
        return $next($request);
    }
}
