<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $fillable = ['name','speciality','type','hospital_id'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withDefault();
    }
}
