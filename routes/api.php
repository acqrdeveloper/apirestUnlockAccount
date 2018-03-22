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


Route::group(['middleware' => ['cors:api']], function () {

    Route::get("/generate-token", "FirebaseController@firebaseGenerate");

    Route::group(['middleware' => ['verify.headers:api']], function () {

        //Unlock
        Route::post("/create-log-unlock", "UnlockController@createLog");
        //Reset
        Route::post("/create-log-reset", "ResetController@createLog");
        //Search
        Route::post("/create-log-search", "SearchController@createLog");

    });

});