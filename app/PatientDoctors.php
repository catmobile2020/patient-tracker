<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDoctors extends Model
{
    protected $fillable = ['from_doctor','to_doctor','user_id','patient_id'];

    public function fromDoctor()
    {
        return $this->belongsTo(Doctor::class,'from_doctor')->withDefault();
    }

    public function toDoctor()
    {
        return $this->belongsTo(Doctor::class,'to_doctor')->withDefault();
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
