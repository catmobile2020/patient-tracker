<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTargets extends Model
{
    protected $fillable = ['number','year','month','hospital_id','user_id'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
