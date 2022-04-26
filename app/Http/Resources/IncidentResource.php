<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
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
            'id'=>$this->id,
            'libelle incident'=>$this->libincident,
            'Dispositif'=>[
                'Reference'=>$this->dispositif->ref,
                'Fiche'=>$this->dispositif->fiche,
                'Numero de telephone'=>$this->dispositif->numero,
                'Date'=>$this->dispositif->date,
              ],
              'Dates'=>$this->dates,
        ];
    }
}
