<?php


namespace App\Filters;


class TargetFilter extends Filters
{
    protected $var_filters=['product','year','month'];

    public function product($value)
    {
        return $this->builder->where('product',$value);
    }

    public function year($value)
    {
        return $this->builder->where('year',$value);
    }

    public function month($value)
    {
        return $this->builder->where('month',$value);
    }
}
