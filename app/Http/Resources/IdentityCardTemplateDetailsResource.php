<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdentityCardTemplateDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'identity_card_template_id' => $this->identity_card_template_id,
            'identity_card_detail_id' => $this->identity_card_detail_id,
            'employee_id'=>$this->employee_id,
            'text_content'=>$this->text_content,
            'image_file'=>$this->image_file,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
    ];

    }
}
