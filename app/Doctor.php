<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    protected $fillable = ['name','speciality','hospital_id'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withDefault();
    }
}
