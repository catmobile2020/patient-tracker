<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerResource extends JsonResource
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
            'type'=>$this->type,
            'name'=>$this->name,
            'speaker_type'=>$this->speaker_type,
            'speciality'=>$this->speciality,
        ];
    }
}
