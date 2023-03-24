<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'honorific' => $this->honorific,
            'post' => $this->post,
            'post_code' => $this->post_code,
            'address' => $this->address,
            'telephone_number' => $this->telephone_number,
            'fax_number' => $this->fax_number,
        ];
    }
}
