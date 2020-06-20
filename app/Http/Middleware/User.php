<?php

namespace App\Http\Middleware;

use Closure;

class User
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
            if($permission == 2){
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
