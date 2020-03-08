<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'name'=>$this->name,
            'speciality'=>$this->speciality,
            'type'=>$this->type,
            'hospital'=>HospitalsResource::make($this->hospital),
            'patients'=>PatientsResource::collection($this->patients),
        ];
    }
}
