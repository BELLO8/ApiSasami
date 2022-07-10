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
            'date_envoie' => date($this->date_envoie),
            'libincident' => $this->Incident->libincident,
            'date_declenchement' => date($this->Incident->date_declenchement),
            'freq_enrg' => $this->Incident->assigner->freq_enrg . ' sec',
            'reference' => $this->Incident->assigner->dispositif->reference,
            'details' => $this->Incident->assigner->dispositif->details,
            'telephone' => $this->Incident->assigner->dispositif->telephone,
            'Adresse_ip' => $this->Incident->assigner->dispositif->Adresse_ip,
            'status' => $this->Incident->assigner->dispositif->status,
            'personne_vulnerable_nom'=>$this->Incident->assigner->personne_vulnerable->nom,
            'personne_vulnerable_prenom'=>$this->Incident->assigner->personne_vulnerable->prenom,
            'personne_vulnerable_telephone'=>$this->Incident->assigner->personne_vulnerable->telephone,
            'personne_vulnerable_age'=>$this->Incident->assigner->personne_vulnerable->age,
            //'constantes' => $this->Incident->assigner->constantes,
        ];
    }
}   
