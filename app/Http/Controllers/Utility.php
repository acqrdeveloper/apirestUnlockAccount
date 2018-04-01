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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait Utility
{

    //Funcion dinamica para obtener configuracion general
    private function getConfigProjectGeneral($request)
    {
        $return = DB::table('config_general')
            ->join('projects', 'projects.id', 'config_general.project_id')
            ->where('projects.name', $request->header('X-Request-Project'))
            ->first();
        return response()->json($return);
    }

    //Funcion dinamica para obtener configuracion de una tablka por proyecto
    private function getConfigProject($table = null, $request)
    {
        return DB::table('config')
            ->join('projects', 'projects.id', 'config.project_id')
            ->where('projects.name', $request->header('X-Request-Project'))
            ->where('action', $table)
            ->first();
    }

    //Funcion dinamica para obtener el Id del proyecto
    private function getTableId($request)
    {
        return (int)Project::where("name", $request->header('X-Request-Project'))->pluck("id")[0];
    }

    //Funcion dinamica para obtener la cantidad de intentos
    private function calculateAttempts($Model, $request)
    {
        //Table config
        $Config = $this->getConfigProject($Model->getTable(), $request);
        $rule_interval_attempt = str_replace("'", '', $Config->interval);
        //Model dinamic
        $Rpta = $Model->select(DB::raw('COUNT(attempt) AS intentos'))
            ->whereBetween('created_at', [$Model->min('created_at'), date('Y-m-d H:i:s')])
            ->where('username', $request->username)
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
        DB::enableQueryLog();
        try {
            $Model->fill($request->all());
            $Model->ip = $request->ip();
            $Model->project_id = $this->getTableId($request);
            $Model->save();
            $query = DB::getQueryLog();
            $this->fnDoLog($query);
            return DB::commit();
        } catch (Exception $e) {
            $query = DB::getQueryLog();
            $this->fnDoLog($e->getMessage(), "error");
            $this->fnDoLog($query);
            DB::rollBack();
            return DB::statement(" ALTER TABLE " . $Model->getTable() . " AUTO_INCREMENT = " . ($Model->count() + 1));
        }
    }

    /**
     * metodo generico que genera/realiza un log segun el tipo sea indicado
     * @param $data
     * @param string $type
     */
    public function fnDoLog($data, $type = "info")
    {
        $path = storage_path() . '/logs/';
        switch ($type) {
            case 'error':
                Log::useFiles($path . 'error.log');
                Log::error($data);
                break;
            default:
                Log::useFiles($path . 'info.log');
                Log::info($data);
                break;
        }
    }

}