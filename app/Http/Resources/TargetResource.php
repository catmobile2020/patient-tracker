<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TargetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'number'=>$this->number,
            'year'=>$this->year,
            'month'=>$this->month,
            'hospital_id'=>HospitalsResource::make($this->hospital),
        ];
    }
}
