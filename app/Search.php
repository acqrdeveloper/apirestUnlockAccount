<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 1/03/2018
 * Time: 17:24
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'search_ad';
    protected $fillable = [
        'project_id',
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
                    "description" => "required",
                    "message" => "required",
                    "status" => "required",
                ];
                break;
        };
        return $rules;
    }
}