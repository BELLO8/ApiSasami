<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlerteResource extends JsonResource
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
            'id' => $this->id,
            'Incident' => [
                'Id incident' => $this->Incident->id,
                'Libelle incident' => $this->Incident->libincident,
                'Dispositif' => [
                    'reference' => $this->Incident->dispositif->ref,
                    'fiche' => $this->Incident->dispositif->fiche,
                    'numero de telephone' => $this->Incident->dispositif->numero,
                    'date' => $this->Incident->dispositif->date,
                ],
                'Dates' => $this->Incident->dates,
            ],
        ];
    }
}
