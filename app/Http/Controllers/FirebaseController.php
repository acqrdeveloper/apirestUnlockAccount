<?php

namespace App\Http\Controllers;

use \Firebase\JWT\JWT;

class FirebaseController
{
    function firebaseGenerate()
    {
        $token = array(
            'sub' => '1234567890',
            'name' => 'Alex Christian',
            'admin' => true,
            'jti' => '9ea1d8c8-522e-4cfc-87e9-a2f891a2c61d',
            'iat' => 1,
            'exp' => time() + (int)env("TIME_JWT"),
        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, env("KEY_JWT"));
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
        JWT::$leeway = (int)env("TIME_JWT"); // $leeway in seconds
        return ["token" => $jwt];
    }

    function firebaseValidate($request)
    {
        return (is_object(JWT::decode($request->header("X-Access-Token-Lvl"), env("KEY_JWT"), ['HS256'])));
    }
}
