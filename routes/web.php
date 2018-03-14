<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


//Router::post("/token", "Controller@getJWTIdentifier");

//Route::options('/{any:.*}',  function () {
//    return response(['status' => 'success']);
//});


Route::group(['middleware' => ['cors']], function () {

    Route::get("/generate-token", "FirebaseController@firebaseGenerate");

    Route::group(['middleware' => ['verify.headers']], function () {

        Route::get("/test-token", "FirebaseController@firebaseUsage");
        //Unlock
        Route::post("/create-log-unlock", "UnlockController@createLog");
        //Reset
        Route::post("/create-log-reset", "ResetController@createLog");
        //Config
        Route::get("/config/{table}", "Controller@config");
        //Search
        Route::post("/create-log-search", "SearchController@createLog");

    });

});