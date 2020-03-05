<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitySpeakers extends Model
{
    protected $fillable = ['type','name','speaker_type','speciality','activity_id'];

    public function activity()
    {
        return $this->belongsTo(Activity::class)->withDefault();
    }
}
