<?php
/**
 * Created by PhpStorm.
 * User: aquispe
 * Date: 6/03/2018
 * Time: 15:20
 */

namespace App\Http\Controllers;


use App\Search;
use Illuminate\Http\Request;
use Exception;

class SearchController extends Controller
{
    //Metodos utiles
    use Utility;

    //Funcion crear log
    function createLog(Request $request)
    {
        $Model = new Search();
        return $this->create($Model, $request);
    }

}