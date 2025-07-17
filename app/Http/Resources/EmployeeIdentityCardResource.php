<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeIdentityCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'employee_id' => $this->employee_id,
        'identity_card_template_id' => $this->identity_card_template_id,
        'image_file' => $this->image_file,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}

}
