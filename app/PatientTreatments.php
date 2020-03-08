<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTreatments extends Model
{
    protected $fillable=['type_medication','etiology','other_medication','patient_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withDefault();
    }
}
