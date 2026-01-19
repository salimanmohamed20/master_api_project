<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;

class ApiController extends Controller
{
    use ApiResponse;
    protected $policyModel=[];
    public function include(string $relations):bool
    {
        $params = request()->get('include');
        if(!$params){
            return false;
        }
        $includes = explode(',',strtolower($params));
        return in_array(strtolower($relations),$includes);

    }

    

public function isAble($ability,$targetModel)
{
    return $this->authorize($ability,[$targetModel,$this->policyModel]);
}





}
