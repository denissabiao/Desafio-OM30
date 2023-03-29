<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{


    public function toArray($request)
    {
        return [
            'zip_code'=> $this->zip_code,
            'street'=> $this->street,
            'number'=> $this->number,
            'neighborhood'=> $this->neighborhood,
            'city'=> $this->city,
            'state'=> $this->state,
            'complement'=> $this->complement,
        ];
    }
}
