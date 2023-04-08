<?php

namespace App\Http\Middleware;

use App\Enums\PositionType;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StaffUksMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->position_id == PositionType::StaffUks || auth()->user()->position_id == PositionType::Administrator) {
            return $next($request);
        }
        Alert::error('Error', 'You are not allowed to access this page');
        return redirect()->back();
    }
}
