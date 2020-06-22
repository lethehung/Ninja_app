<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        {
            $permission = Auth::user()->permission;
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
