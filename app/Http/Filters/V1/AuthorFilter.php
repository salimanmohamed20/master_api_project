<?php

namespace App\Http\Filters\V1;



class AuthorFilter extends QueryFilter
{

    public function email($val){
        $likeString=str_replace(' ','%',$val);
        return $this->builder->where('email','like',$likeString);
    }
    public function include($val){
        return $this->builder->with(explode(',',$val));
    }

    public function createdAt($val)
    {
        $dates=explode(',',$val);
        if(count($dates)>1){
            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at', $val);
    }


}
