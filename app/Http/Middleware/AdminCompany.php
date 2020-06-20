<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permission = Auth::user()->permission;
        if($permission == 1){
            return $next($request);
        }
        else{
            return response()->json([
                'error' => 'permission denied'
            ],404);
        }

    }
}
