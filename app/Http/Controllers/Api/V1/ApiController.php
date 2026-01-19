<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;

class ApiController extends Controller
{
    use ApiResponse;
    public function include(string $relations):bool
    {
        $params = request()->get('include');
        if(!$params){
            return false;
        }
        $includes = explode(',',strtolower($params));
        return in_array(strtolower($relations),$includes);

    }
}
