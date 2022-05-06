<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveilleResource extends JsonResource
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
            "id" => $this->id,
            'nom_vulnerable' => $this->Personne_vulnerable->nom,
            'prenom_vulnerable' => $this->Personne_vulnerable->prenom,
            'adresse_vulnerable' => $this->Personne_vulnerable->adresse,
            'telephone_vulnerable' => $this->Personne_vulnerable->telephone,
            'age_vulnerable' => $this->Personne_vulnerable->age,
            'nom_affiliee' => $this->Personne_affilee->nom,
            'prenom_affiliee' => $this->Personne_affilee->prenom,
            'adresse_affiliee' => $this->Personne_vulnerable->adresse,
            'telephone_affiliee' => $this->Personne_affilee->telephone,
            'age_affiliee' => $this->Personne_affilee->age
        ];
    }
}
