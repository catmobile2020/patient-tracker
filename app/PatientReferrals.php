<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReferrals extends Model
{
    protected $fillable=['from_hospital','to_hospital','from_doctor','to_doctor','user_id','patient_id'];


    public function fromHospital()
    {
        return $this->belongsTo(Hospital::class,'from_hospital')->withDefault();
    }

    public function toHospital()
    {
        return $this->belongsTo(Hospital::class,'to_hospital')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withDefault();
    }
}
