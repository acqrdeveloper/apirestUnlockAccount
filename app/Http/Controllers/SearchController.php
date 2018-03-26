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

class SearchController extends Controller
{
    use Utility;
    //Funcion crear log
    function createLog(SearchRequest $request)
    {
        $Model = new Search();
        return $this->create($Model, $request);
    }

}