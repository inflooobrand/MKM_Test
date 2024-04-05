<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource{

  public function toArray($request)
  {
    return [
          'id' =>$this->id,
          'sku' =>$this->sku,
          'name' =>$this->name,
          'description' =>$this->description,
          'brand'=>$this->brand
    ];
  }
}