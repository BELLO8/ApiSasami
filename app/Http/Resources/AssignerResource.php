<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignerResource extends JsonResource
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
            'frequenceD'=>$this->frequenceD,
            'dates'=>$this->dates,
            'Dispositif'=>[
                'id'=>$this->dispositif->id,
                'reference'=>$this->dispositif->ref,
                'fiche'=>$this->dispositif->fiche,
                'numero de telephone'=>$this->dispositif->numero,
                'date'=>$this->dispositif->date,
              ],
            'personne_vulnerable'=>[
                'id'=>$this->personne_vulnerable->id,
                'nom'=>$this->personne_vulnerable->nom,
                'prenom'=>$this->personne_vulnerable->prenom,
                'adresse'=>$this->personne_vulnerable->adresse,
                'telephone'=>$this->personne_vulnerable->telephone,
                'age'=>$this->personne_vulnerable->age,
            ],
        ];
    }
}
