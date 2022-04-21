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
                'libincident' => $this->Incident->libincident,
                'Dispositif' => [
                    'ref' => $this->Incident->dispositif->ref,
                    'fiche' => $this->Incident->dispositif->fiche,
                    'numero' => $this->Incident->dispositif->numero,
                    'date' => $this->Incident->dispositif->date,
                ],
                'dates' => $this->Incident->dates,
            ],
        ];
    }
}
