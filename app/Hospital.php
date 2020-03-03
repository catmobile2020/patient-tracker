<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{

    protected $fillable =['name','type','rheuma','crdio','pulmo','pah_expert','rhc','rwe','echo','pah_attentive','city_id','country_id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
