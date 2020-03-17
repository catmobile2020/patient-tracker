<?php

namespace App;

use App\Filters\TargetFilter;
use Illuminate\Database\Eloquent\Model;

class UserTargets extends Model
{
    protected $fillable = ['product','number','year','month','hospital_id','user_id'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function scopeFilter($query,TargetFilter $filter)
    {
        return $filter->apply($query);
    }
}
