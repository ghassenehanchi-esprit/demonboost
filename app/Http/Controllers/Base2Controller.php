<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class Base2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $adminNotifications = [];

            if (Auth::check() && Auth::user()->is_admin) {
                // Fetch the admin notifications from the database or any other source
                $adminNotifications = Notification::where('is_admin', 1)->get();
            }

            // Share the admin notifications variable with all views that use the base2 layout
            view()->share('adminNotifications', $adminNotifications);

            return $next($request);
        });
    }
}
