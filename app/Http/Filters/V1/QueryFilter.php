<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $builder;
    protected $request;
    protected $sort=[];

    public function __construct(Request  $request)
    {
        $this->request = $request;
    }
protected function filter($arr)
{
    foreach ($arr as $filter => $value) {
        if (method_exists($this, $filter)) {
            $this->$filter($value);
        }
        return $this->builder;
    }
}
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }
    protected function sort($val)
    {
        $sortFields = explode(',', $val);
        foreach ($sortFields as $field) {
            $direction = 'asc';
            if (substr($field, 0, 1) === '-') {
                $direction = 'desc';
                $field = ltrim($field, '-');
            }
            if (!in_array($field, $this->sort) && !array_key_exists($field, $this->sort)) {
                continue;
            }
            $column = $this->sort[$field] ?? $field;
            if($column === null){
              $column=$field;
            }
            $this->builder->orderBy($column, $direction);
        }
        return $this->builder;
    }
}
