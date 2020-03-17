<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=['type','subtype','product','date','speciality','no_attendees','city_id','user_id'];

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

    public function setSpecialityAttribute($value)
    {
        $this->attributes['speciality'] = serialize($value);
    }

    public function getSpecialityAttribute()
    {
        return unserialize($this->attributes['speciality']);
    }

    public function setNoAttendeesAttribute($value)
    {
        $this->attributes['no_attendees'] = serialize($value);
    }

    public function getNoAttendeesAttribute()
    {
        return unserialize($this->attributes['no_attendees']);
    }
}
