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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::group(['middleware' => 'cors'], function () {
//    Route::middleware("cors")->options('/api/{any:.*}', function () {
//        return response(['status' => 'success']);
//    });
//    Route::group(['middleware' => 'api'], function ($router) {
//
//
//    $router::get("/generate-token", "FirebaseController@firebaseGenerate");
//    $router::get("/test-token", "FirebaseController@firebaseUsage");
//
//    //Test
//    $router->get('/user', function(Request $request){
//        return $request->ip();
//    });
//    //Unlock
//    $router->post("/create-log-unlock", "UnlockController@createLog");
//    //Reset
//    $router->post("/create-log-reset", "ResetController@createLog");
//    //Config
//    $router->get("/config/{table}", "Controller@config");
//    //Search
//    $router->post("/create-log-search", "SearchController@createLog");
//
//    });
//});