<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{

    protected $fillable =['name','type','rheuma','crdio','pulmo','pah_expert','rhc','rwe','echo','pah_attentive','city_id','country_id','user_id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function targets()
    {
        return $this->hasMany(UserTargets::class);
    }
}
