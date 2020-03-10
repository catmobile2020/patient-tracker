<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'id' =>$this->id,
            'name' =>$this->name,
            'email' =>$this->email,
            'active' => (boolean)$this->active,
            'type' =>$this->type,
            'photo' =>$this->photo,
            'device_token' =>$this->device_token,
        ];
    }
}
