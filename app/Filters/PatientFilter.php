<?php


namespace App\Filters;


class PatientFilter extends Filters
{
    protected $var_filters=['status','city_id','country_id','hospital_id','doctor_id','hospital_type'];

    public function status($value)
    {
        return $this->builder->where('status',$value);
    }

    public function city_id($value)
    {
        return $this->builder->where('city_id',$value);
    }

    public function country_id($value)
    {
        return $this->builder->where('country_id',$value);
    }

    public function hospital_id($value)
    {
        return $this->builder->where('hospital_id',$value);
    }

    public function doctor_id($value)
    {
        return $this->builder->where('doctor_id',$value);
    }
    public function hospital_type($value)
    {
        return $this->builder->whereHas('hospital',function ($q) use ($value){
            $q->where('type',$value);
        });
    }


}
