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

Route::group(['middleware' => ['cors']], function () {
    if (!request()->ajax()) {
        Route::get('/', function () {
            return response()->view("errors.404");
        });
    }
});

Route::group(['middleware' => ['cors:api']], function () {

    if (!request()->ajax()) {
        Route::get('/{any}', function () {
            return response()->view("errors.404");
        });
    } else {
        Route::get("/generate-token", "FirebaseController@firebaseGenerate");
        Route::get("/get-config", "Controller@configProjectGeneral");

        Route::group(['middleware' => ['verify.headers:api']], function () {

            //Unlock
            Route::post("/create-log-unlock", "UnlockController@createLog");
            //Reset
            Route::post("/create-log-reset", "ResetController@createLog");
            //Search
            Route::post("/create-log-search", "SearchController@createLog");

        });
    }

});