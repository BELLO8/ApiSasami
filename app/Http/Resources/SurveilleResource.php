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

                "id"=>$this->id,
                "personne_vulnerable"=> [
                    'nom'=>$this->Personne_vulnerable->nom,
                    'prenom'=>$this->Personne_vulnerable->prenom,
                    'adresse'=>$this->Personne_vulnerable->adresse,
                    'telephone'=>$this->Personne_vulnerable->telephone,
                    'age'=>$this->Personne_vulnerable->age
                ],
                "Suivis par" =>[
                    "personne_Affilee"=>[
                        'nom'=>$this->Personne_affilee->nom,
                        'prenom'=>$this->Personne_affilee->prenom,
                        'adresse'=>$this->Personne_vulnerable->adresse,
                        'telephone'=>$this->Personne_affilee->telephone,
                        'age'=>$this->Personne_affilee->age
                        ]
                ]



        ];
    }
}
