<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfillingResource extends JsonResource
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
            'temperatureM'=>$this->temperatureM,
            'nombre_pasM'=>$this->nombre_pasM,
            'frequence_resM'=>$this->frequence_resM,
            'rythme_cardM'=>$this->telephone,
            'dates'=>$this->dates,
            'id_assigner'=>$this->id_assigner
        ];
    }
}
