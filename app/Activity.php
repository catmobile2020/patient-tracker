<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=['type','subtype','date','no_attendees','city_id','user_id'];

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function speakers()
    {
        return $this->hasMany(ActivitySpeakers::class);
    }
}
