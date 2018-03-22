<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseController;
use App\Project;
use Closure;
use Illuminate\Http\Request;

class VerifyHeaders
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = null;
        $msg1 = $this->verifyProject($request)["status"];
        $msg2 = $this->verifyToken($request)["status"];
        if ($msg1 && $msg2) {
            $response = $next($request);
        } else {
            if (!$msg1) $response = response()->json($this->verifyProject($request)["data"], 401);
            if (!$msg2) $response = response()->json($this->verifyToken($request)["data"], 401);
        }
        return $response;
    }

    private function verifyProject($request)
    {
        if ($request->hasHeader('X-Request-Project')) {
            if (Project::where("name", $request->header('X-Request-Project'))->first() !== null) {
                $response = ["status" => true, "data" => ""];
            } else {
                $response = ["status" => false, "data" => "Cabecera no autorizada"];
            }
        } else {
            $response = ["status" => false, "data" => "Error, procedimiento no autorizado"];
        }
        return $response;
    }

    private function verifyToken($request)
    {
        if ($request->hasHeader('X-Access-Token-Lvl')) {
            if ((new FirebaseController())->firebaseValidate($request)["status"]) {
                $response = ["status" => true, "data" => ""];
            } else {
                $response = ["status" => false, "data" => (new FirebaseController())->firebaseValidate($request)["data"]];
            }
        } else {
            $response = ["status" => false, "data" => "Error, procedimiento no autorizado"];
        }
        return $response;
    }

}
