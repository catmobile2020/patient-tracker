<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    protected $fillable=['status','user_id','patient_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withDefault();
    }
}
