<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationUnit extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organization_units';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'en_name',
                    'en_acronym',
                    'parent',
                    'reports_to',
                    'location',
                    'is_root_unit',
                    'is_category',
                    'synchronize_status',
                    'organization_id',
                    'chairman'                    
                ];

    public function organization() {
    return $this->belongsTo(Organization::class);
    }

    public function parentUnit() {
        return $this->belongsTo(OrganizationUnit::class, 'parent');
    }

    public function reportingUnit() {
        return $this->belongsTo(OrganizationUnit::class, 'reports_to');
    }

    // Assuming chairman references a User model
    public function chairperson() {
        return $this->belongsTo(User::class, 'chairman');
    }


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];



}
