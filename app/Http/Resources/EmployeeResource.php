<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        // if you want to show some fields only you can use the below return way 

        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
    
        // ]
        
    }
}
