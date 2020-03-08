<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReferrals extends Model
{
    protected $fillable=['from_user','to_user','patient_id'];


    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user')->withDefault();
    }

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user')->withDefault();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withDefault();
    }
}
