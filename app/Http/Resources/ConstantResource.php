<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConstantResource extends JsonResource
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
            "temperature" => $this->temperature ,
            "nombre_pas" => $this->nombre_pas ,
            "frequence_res" => $this->frequence_res ,
            "rythme_card" => $this->rythme_card ,
            "coordonnee_geographique" => $this->coordonnee_geographique,
            "date" => $this->date,
            "assigner" => new AssignerResource($this->assigner),
        ];
    }
}