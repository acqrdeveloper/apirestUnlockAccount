<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::group(['middleware' => ['cors']], function () {
//    if (!request()->ajax()) {
//        Route::get('/', function () {
//            return response()->view("errors.404");
//        });
//    }
//});

Route::group(['middleware' => ['cors:api']], function () {

//    if (!request()->ajax()) {
//        Route::get('/{any}', function () {
//            return response()->view("errors.404");
//        });
//    } else {
        Route::get("/generate-token", "FirebaseController@firebaseGenerate");
        Route::get("/get-config", "Controller@configProjectGeneral");
        Route::get("/unlockresetuser/search/{textSearch}",function($textSearch){
                $string = file_get_contents(asset("/data.json"));
                $array = json_decode($string);
                foreach ($array as $item){
                    $item = (object)$item;
                    if($textSearch == $item->username || $textSearch == $item->dni || $textSearch == $item->email){
                        return response()->json($item,200);
                    } else {
                        continue;
                    }
                }
                return response()->json("No se ha encontrado a este usuario",412);
        });

        Route::group(['middleware' => ['verify.headers:api']], function () {
            //Unlock
            Route::post("/create-log-unlock", "UnlockController@createLog");
            //Reset
            Route::post("/create-log-reset", "ResetController@createLog");
            //Search
            Route::post("/create-log-search", "SearchController@createLog");
        });
//    }

});