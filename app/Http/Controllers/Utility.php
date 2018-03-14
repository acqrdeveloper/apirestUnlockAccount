<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 5/03/2018
 * Time: 11:53
 */

namespace App\Http\Controllers;


use App\Project;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;

trait Utility
{

    //Funcion dinamica para obtener configuracion
    private function getConfig($table)
    {
        return DB::table('config')->where('action', $table)->first();
    }
    //Funcion dinamica para obtener el Id del proyecto
    private function  getTableId($request)
    {
        return (int)Project::where("name",$request->header('X-Request-Project'))->pluck("id")[0];
    }

    //Funcion dinamica para obtener la cantidad de intentos
    private function calculateAttempts($Model)
    {
        //Table config
        $Config = $this->getConfig($Model->getTable());
        $rule_interval_attempt = str_replace("'", '', $Config->interval);
        //Model dinamic
        $Rpta = $Model->select(DB::raw('COUNT(attempt) as intentos'))
            ->whereBetween('created_at', [$Model->min('created_at'), date('Y-m-d H:i:s')])
            ->where('created_at', '>=', DB::raw($rule_interval_attempt))
            ->where('status', '1')
            ->first();
        //Output
        return $Rpta->intentos;
    }

    //Funcion dinamica para hacer el insert
    private function create($Model, $request)
    {
        DB::beginTransaction();
        try {
            $Model->fill($request->all());
            $Model->ip = $request->ip();
            $Model->project_id = $this->getTableId($request);
            $Model->save();
            return DB::commit();
        } catch (Exception $e) {
            echo $e->getMessage();
            DB::rollBack();
            return DB::statement(" ALTER TABLE " . $Model->getTable() . " AUTO_INCREMENT = " . ($Model->count() + 1));
        }
    }

}