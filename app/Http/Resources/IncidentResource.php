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
            'libincident'=>$this->libincident,
            'Dispositif'=>[
                'id'=>$this->dispositif->id,
                'reference'=>$this->dispositif->ref,
                'fiche'=>$this->dispositif->fiche,
                'numero de telephone'=>$this->dispositif->numero,
                'date'=>$this->dispositif->date,
              ],
              'dates'=>$this->dates,
        ];
    }
}
