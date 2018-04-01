<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 1/03/2018
 * Time: 16:24
 */

namespace App\Http\Controllers;


use App\Unlock;
use Illuminate\Http\Request;

class UnlockController extends Controller
{
    use Utility;

    //Log
    function createLog(Request $request)
    {
        $Model = new Unlock();
        if ($this->calculateAttempts($Model, $request) <= 2) {
            return $this->create($Model, $request);
        } else {
            $msg = "Estimado $request->username, ha superado el limite de intentos para desbloquear";
            $request->request->set("description", "$request->username no pudo desbloquear su cuenta");
            $request->request->set("status", 0);
            $request->request->add(["message" => $msg]);
            $this->create($Model, $request);
            return response()->json($msg, 412);
        }
    }

    //User
    function unlock(Request $request)
    {
        $Model = new Unlock();
        if ($this->calculateAttempts($Model, $request) <= 2) {
            return response()->json("Estimado $request->username, su cuenta ha sido desbloqueada con exito", 200);
        } else {
            return response()->json("Estimado $request->username, ha superado el limite de intentos para desbloquear", 412);
        }
    }

}