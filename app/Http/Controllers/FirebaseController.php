<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Exception;

class FirebaseController extends Controller
{
    function firebaseGenerate()
    {
        $token = array(
            'name' => 'Corporacion Sapia',
            'created_at' => '2018-02-26 00:00:00',
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'admin' => true,
            'iat' => 1,
            'exp' => time() + (int)config()["app"]["jwt_time"],
        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, config()["app"]["jwt_key"]);
        /*
         NOTE: This will now be an object instead of an associative array. To get
         an associative array, you will need to cast it as such:
        */


        /**
         * You can add a leeway to account for when there is a clock skew times between
         * the signing and verifying servers. It is recommended that this leeway should
         * not be bigger than a few minutes.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        JWT::$leeway = (int)config()["app"]["jwt_time"]; // $leeway in seconds
        return ["token" => $jwt];
    }

    function firebaseValidate($request)
    {
        $response = null;
        try {
            $validate = (is_object(JWT::decode($request->header("X-Access-Token-Lvl"), config()["app"]["jwt_key"], ['HS256'])));
            if ($validate) $response = ["status" => true, "data" => "Token generado"];
        } catch (Exception $e) {
            $response = ["status" => false, "data" => "El token ha expirado o no tiene autorizacion"];
        }
        return $response;
    }
}
