<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'type'=>$this->type,
            'subtype'=>$this->subtype,
            'date'=>$this->date,
            'no_attendees'=>$this->no_attendees,
            'created_at'=>$this->created_at->format('d/m/Y h:i A'),
            'city'=>CityResource::make($this->city),
            'user'=>AccountResource::make($this->user),
            'speakers'=>SpeakerResource::collection($this->speakers),
        ];
    }
}
