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
            'id' => $this->id,
            'reference' => $this->reference,
            'details' => $this->details,
            'telephone' => $this->numero,
            'Adresse_ip' => $this->Adresse_ip,
            'status' => $this->status,
            'date' => date($this->date),
        ];
    }
}
