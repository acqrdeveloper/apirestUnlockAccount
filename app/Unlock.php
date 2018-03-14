<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 1/03/2018
 * Time: 17:24
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Unlock extends Model
{
    protected $table = 'unlock_ad';
    protected $fillable = [
        'project_id',
        'username',
        'description',
        'message',
        'ip',
        'status',
    ];
    function returnRules($request)
    {
        $rules = [];
        switch ($request->method()) {
            case "POST":
                $rules = [
                    "username" => "required",
                    "description" => "required",
                    "message" => "required",
                    "ip" => "required",
                    "status" => "required",
                ];
                break;
        };
        return $rules;
    }
}