<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompaniesResource extends JsonResource
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
            'company' => $this->company,
            'code' => $this->code,
            'vat' => $this->vat,
            'address' => $this->address,
            'director' => $this->director,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'logo' => $this->logo,
            'user' => $this->user
        ];
        //return parent::toArray($request);
    }
}
