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
use Illuminate\Support\Facades\DB;

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
        $User = DB::table("users")
            ->where(function ($query) use ($request) {
                $query->where("users.username", $request->text_search);
                $query->orWhere("users.dni", $request->text_search);
                $query->orWhere("users.email", $request->text_search);
            })
            ->first();

        if ($User) {
            return response()->json($User, 200);
        } else {
            return response()->json("$request->text_search no ha sido encontrado en la base de datos.", 412);
        }

//        if($request->text_search == $item->username || $request->text_search == $item->dni || $request->text_search == $item->email){
//        } else {
//            continue;
//        }
//
//        $string = file_get_contents(asset("/data.json"));
//        $array = json_decode($string);
//        foreach ($array as $item){
//            $item = (object)$item;
//            if($request->text_search == $item->username || $request->text_search == $item->dni || $request->text_search == $item->email){
//                return response()->json($item,200);
//            } else {
//                continue;
//            }
//        }
//
//        return response()->json("$request->text_search no ha sido encontrado en la base de datos.",412);
    }

}