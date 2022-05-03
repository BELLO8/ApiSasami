<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FicheResource extends JsonResource
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
            "id_personne_vulnerable" => $this->Personne_vulnerable,
            "poids" => $this->poids,
            "taille" => $this->taille,
            "probleme_medicale" => $this->probleme_medicale,
            "traitement" => $this->traitement,
            "groupe_sanguin" => $this->groupe_sanguin,
            "contact_personne_proche" => $this->contact_personne_proche,
        ];
    }
}
