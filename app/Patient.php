<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable=['name','status','city_id','country_id','hospital_id','doctor_id','user_id'];

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withDefault();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function referrals()
    {
        return $this->hasMany(PatientReferrals::class);
    }

    public function histories()
    {
        return $this->hasMany(PatientHistory::class);
    }

    public function treatments()
    {
        return $this->hasMany(PatientTreatments::class);
    }
}
