<?php

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

    if (request()->ajax()) {

        Route::get("/generate-token", "FirebaseController@firebaseGenerate");
        Route::get("/get-config", "Controller@configProjectGeneral");

        Route::group(['middleware' => ['verify.headers:api']], function () {

            Route::get("/active-directory/validate-reset",function(){
                return response()->json(true,200);
            });

            Route::get("/active-directory/search","SearchController@search");
            Route::get("/active-directory/unlock","UnlockController@unlock");
            Route::get("/active-directory/reset","ResetController@reset");

            Route::post("/create-log-unlock", "UnlockController@createLog");//Unlock
            Route::post("/create-log-reset", "ResetController@createLog");//Reset
            Route::post("/create-log-search", "SearchController@createLog");//Search

        });

    } else {

        Route::get('{any}', function () {
            return response()->view("errors.404");
        });

    }

});