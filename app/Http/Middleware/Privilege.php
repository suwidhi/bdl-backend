<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $priv)
    {
        // $user = Auth::user();
        // return response([
        //     'data' => $user
        // ]);
        // if($user->type == $priv){
        //     return $next($request);
        // } else {
        //     return response([
        //         'message' => $priv
        //     ], 401);
        // }

        return $next($request);
    }
}
