<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        {
            $permission = Auth::user()->permisson;
            if($permission == 0){
                return $next($request);
            }
            else{
                return response()->json([
                    'error' => 'permission denied'
                ],404);
            }

        }
    }
}
