<?php

namespace App\Http\Resources;

use App\Enum\Unit;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name" => $this->name ,
            "price" => $this->price,
            "cost" => $this->cost ,
            "description" => $this->description ,
            "images" => ImageResource::collection($this->images) ,
            "unit" =>$this->unit?->weightPerUnit
                                                .match (true) {
                                                    $this->unit?->unit == 'pcs' => ' g',
                                                    $this->unit?->unit == 'uov' => ' ml', 
                                                    default => null,
                                                }

        ];
    }
 
}
