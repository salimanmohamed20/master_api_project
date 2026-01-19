<?php

namespace App\Http\Filters\V1;


class TicketFilter extends QueryFilter
{
protected $sort=[
    'createdAt'=>'created_at',
    'status',
];
public function include($val){
        return $this->builder->with(explode(',',$val));
}
    public function status($val){
        return $this->builder->whereIn('status',explode(',',$val));
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
