<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 1/03/2018
 * Time: 16:24
 */

namespace App\Http\Controllers;


use App\Reset;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    use Utility;

    //Log
    function createLog(Request $request)
    {
        $Model = new Reset();
        if ($this->calculateAttempts($Model,$request) <= 2) {
            return $this->create($Model, $request);
        } else {
            $msg = "Estimado $request->username, ustéd ha superado el limite de intentos para resetear su contraseña";
            $request->request->set('description', $request->username . " no pudo resetear su contraseña");
            $request->request->set('status', 0);
            $request->request->add(['message' => $msg]);
            $this->create($Model, $request);
            return response()->json($msg, 412);
        }
    }

}