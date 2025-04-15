<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_positions';

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
                    'organization_unit_id',
                    'job_title_category_id',
                    'job_description',
                    'position_code',
                    'position_id',
                    'salary_id',
                    'status'
                ];

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
    
    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnit()
    {
        return $this->belongsTo('App\Models\OrganizationUnit','organization_unit_id');
    }

    /**
     * Get the jobTitleCategory for this model.
     *
     * @return App\Models\JobTitleCategory
     */
    public function jobTitleCategory()
    {
        return $this->belongsTo('App\Models\JobTitleCategory','job_title_category_id');
    }

    /**
     * Get the position for this model.
     *
     * @return App\Models\Position
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Position','position_id');
    }

    /**
     * Get the salary for this model.
     *
     * @return App\Models\Salary
     */
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary','salary_id');
    }



}
