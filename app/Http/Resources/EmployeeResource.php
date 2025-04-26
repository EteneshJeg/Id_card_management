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
        // return parent::toArray($request);
        // if you want to show some fields only you can use the below return way 

        return [
            'id' => $this->id,
            'en_name' => $this->en_name,
            'title' => $this->title,
            'sex' => $this->sex,
            'date_of_birth' => $this->date_of_birth,
            'joined_date' => $this->joined_date,
            'photo_url' => $this->photo ? asset("storage/{$this->photo}") : null,
            'phone_number' => $this->phone_number,
            
            // Relationships
            'organization_unit' => new OrganizationUnitResource($this->whenLoaded('organizationUnit')),
            'job_position' => new JobPositionResource($this->whenLoaded('jobPosition')),
            'job_title_category' => new JobTitleCategoriesResource($this->whenLoaded('jobTitleCategory')),
            'salary' => new SalaryResource($this->whenLoaded('salary')),
            'marital_status' => new MaritalStatusResource($this->whenLoaded('maritalStatus')),
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'region' => new RegionResource($this->whenLoaded('region')),
            'zone' => new ZoneResource($this->whenLoaded('zone')),
            'woreda' => new WoredaResource($this->whenLoaded('woreda')),

            // Remaining fields
            'status' => $this->status,
            'id_issue_date' => $this->id_issue_date,
            'id_expire_date' => $this->id_expire_date,
            'id_status' => $this->id_status,
    
        ]; 


    
        
    }
}
