<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DispositifResource extends JsonResource
{
	public function __construct()
	{
	}
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
            'Reference'=>$this->ref,
            'fiche Technique'=>$this->fiche,
            'Numero'=>$this->numero,
            'Date'=>$this->date
        ];
    }
}
