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
    //Funcion crear log
    function createLog(Request $request)
    {
        $Model = new Unlock();
        if ($this->calculateAttempts($Model,$request) <= 2) {
            return $this->create($Model, $request);
        } else {
            $msg = "Estimado $request->username, ustéd ha superado el limite de intentos para desbloquear";
            $request->request->set("description", $request->username . " no pudo desbloquear su cuenta");
            $request->request->set("status", 2);
            $request->request->add(["message" => $msg]);
            $this->create($Model, $request);
            return response()->json($msg, 412);
        }
    }

}