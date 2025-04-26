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
            'type' => $this->type,
            'file' => $this->file,
            'file_url' => $this->file ? asset("storage/{$this->file}") : null,
            'sample_file' => $this->sample_file,
            'sample_file_url' => $this->sample_file ? asset("storage/{$this->sample_file}") : null,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
    ];

    }
}
