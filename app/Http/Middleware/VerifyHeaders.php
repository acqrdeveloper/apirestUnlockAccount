<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseController;
use Closure;

class VerifyHeaders
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
        $response = null;
        if ($request->hasHeader('X-Request-Project') && $request->hasHeader('X-Access-Token-Lvl')) {
            if ((new FirebaseController())->firebaseValidate($request)) {
                $response = $next($request);
            } else {
                $response = response()->json("Usuario no autorizado",401);
            }
        } else {
            $response = response()->json("Usuario no autorizado",401);
        }
        return $response;
    }
}
