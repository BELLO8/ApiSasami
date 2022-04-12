<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonneVulnerableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nom'=>$this->nom,
            'prenom'=>$this->prenom,
            'adresse'=>$this->adrersse,
            'telephone'=>$this->telephone,
            'age'=>$this->age
        ];
    }
}
