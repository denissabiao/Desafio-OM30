<?php

namespace App\Http\Resources;

use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    private $address;

    public function __construct($resource, $address)
    {
        $this->address = $address;
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        
        return [
            'image'=> $this->image,
            'name'=> $this->name,
            'mother_name'=> $this->mother_name,
            'birth_date'=> $this->birth_date,
            'cpf'=> $this->cpf,
            'cns'=> $this->cns,
            'address' => new AddressResource($this->address),
        ];
    }
}
