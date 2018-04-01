<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 6/03/2018
 * Time: 15:20
 */

namespace App\Http\Controllers;


use App\Http\Requests\SearchRequest;
use App\Search;

class SearchController extends Controller
{
    use Utility;

    //Log
    function createLog(SearchRequest $request)
    {
        $Model = new Search();
        return $this->create($Model, $request);
    }

    //User
    function search(SearchRequest $request)
    {
        $string = file_get_contents(asset("/data.json"));
        $array = json_decode($string);
        foreach ($array as $item){
            $item = (object)$item;
            if($request->text_search == $item->username || $request->text_search == $item->dni || $request->text_search == $item->email){
                return response()->json($item,200);
            } else {
                continue;
            }
        }
        return response()->json("$request->text_search no ha sido encontrado en la base de datos.",412);
    }

}