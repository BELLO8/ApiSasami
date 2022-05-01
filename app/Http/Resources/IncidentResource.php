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
            'id' => $this->id,
            'libelle incident' => $this->libincident,
            'freq_enrg' => $this->assigner->freq_enrg . ' sec',
            'Dispositif' => [
                'reference' => $this->assigner->dispositif->reference,
                'details' => $this->assigner->dispositif->details,
                'telephone' => $this->assigner->dispositif->telephone,
                'Adresse_ip' => $this->assigner->dispositif->Adresse_ip,
                'status' => $this->assigner->dispositif->status,
            ],
            'personne_vulnerable' => [
                'nom' => $this->assigner->personne_vulnerable->nom,
                'prenom' => $this->assigner->personne_vulnerable->prenom,
                'adresse' => $this->assigner->personne_vulnerable->adresse,
                'telephone' => $this->assigner->personne_vulnerable->telephone,
                'age' => $this->assigner->personne_vulnerable->age,
            ],

            'date_declenchement' => date($this->date_declenchement),
        ];
    }
}
