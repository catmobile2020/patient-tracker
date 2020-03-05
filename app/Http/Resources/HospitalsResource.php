<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HospitalsResource extends JsonResource
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
            'type'=>$this->type,
            'rheuma'=>$this->rheuma,
            'crdio'=>$this->crdio,
            'pulmo'=>$this->pulmo,
            'pah_expert'=>$this->pah_expert,
            'rhc'=>$this->rhc,
            'rwe'=>$this->rwe,
            'echo'=>$this->echo,
            'pah_attentive'=>$this->pah_attentive,
            'city'=>CityResource::make($this->city),
            'country'=>CountriesResource::make($this->country),
            'user'=>AccountResource::make($this->user),
        ];
    }
}
