<?php

namespace App\Models;
use Carbon\Carbon;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

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
                  'title',
                  'sex',
                  'date_of_birth',
                  'joined_date',
                  'photo',
                  'phone_number',
                  'organization_unit_id',
                  'job_position_id',
                  'job_title_category_id',
                  'salary',
                  'martial_status_id',
                  'nation',
                  'employment_id',
                  'job_position_start_date',
                  'job_position_end_date',
                  'address',
                  'house_number',
                  'region_id',
                  'zone_id',
                  'woreda_id',
                  'status',
                  'id_issue_date',
                  'id_expire_date',
                  'id_status'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    protected $casts = [
        'date_of_birth' => 'datetime:Y-m-d',
        'joined_date' => 'datetime:Y-m-d',
        'job_position_start_date' => 'datetime:Y-m-d',
        'job_position_end_date' => 'datetime:Y-m-d',
        'id_issue_date' => 'datetime:Y-m-d',
        'id_expire_date' => 'datetime:Y-m-d',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [];
    
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
     * Get the jobPosition for this model.
     *
     * @return App\Models\JobPosition
     */
    public function jobPosition()
    {
        return $this->belongsTo('App\Models\JobPosition','job_position_id');
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
     * Get the salary for this model.
     *
     * @return App\Models\Salary
     */
    

    /**
     * Get the martialStatus for this model.
     *
     * @return App\Models\MartialStatus
     */
    public function maritalStatus()
    {
        return $this->belongsTo('App\Models\MaritalStatus','martial_status_id');
    }

    /**
     * Get the employment for this model.
     *

    /**
     * Get the region for this model.
     *
     * @return App\Models\Region
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region','region_id');
    }

    /**
     * Get the zone for this model.
     *
     * @return App\Models\Zone
     */
    public function zone()
    {
        return $this->belongsTo('App\Models\Zone','zone_id');
    }

    /**
     * Get the woreda for this model.
     *
     * @return App\Models\Woreda
     */
    public function woreda()
    {
        return $this->belongsTo('App\Models\Woreda','woreda_id');
    }

    public function user()
{
    return $this->hasOne(User::class, 'employee', 'id');
}


    
    // public function organizationUnits()
    // {
    //     return $this->hasMany(OrganizationUnit::class, 'chairman_id');
    // }

    /**
     * Set the date_of_birth.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateOfBirthAttribute($value)
     {
    if (empty($value)) {
        $this->attributes['date_of_birth'] = null;
    } elseif ($value instanceof \DateTime) {
        $this->attributes['date_of_birth'] = $value->format('Y-m-d');
    } else {
        // Try to parse date, fallback to null if invalid
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if ($date !== false) {
            $this->attributes['date_of_birth'] = $date->format('Y-m-d');
        } else {
            $this->attributes['date_of_birth'] = null; // or handle error
        }
    }
}

    /**
     * Set the joined_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setJoinedDateAttribute($value)
{
    if (empty($value)) {
        $this->attributes['joined_date'] = null;
    } else {
        // Try parsing both formats:
        $date = \DateTime::createFromFormat('Y-m-d', $value);

        if ($date === false) {
            // fallback: try j/n/Y
            $date = \DateTime::createFromFormat('j/n/Y', $value);
        }

        if ($date !== false) {
            $this->attributes['joined_date'] = $date->format('Y-m-d');
        } else {
            // Invalid date string - assign null or handle error
            $this->attributes['joined_date'] = null;
        }
    }
}


    /**
     * Set the job_position_start_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setJobPositionStartDateAttribute($value)
     {
    if (empty($value)) {
        $this->attributes['job_position_start_date'] = null;
    } elseif ($value instanceof \DateTime) {
        $this->attributes['job_position_start_date'] = $value->format('Y-m-d');
    } else {
        // Try to parse date, fallback to null if invalid
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if ($date !== false) {
            $this->attributes['job_position_start_date'] = $date->format('Y-m-d');
        } else {
            $this->attributes['job_position_start_date'] = null; // or handle error
        }
    }
}

    /**
     * Set the job_position_end_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setJobPositionEndDateAttribute($value)
     {
    if (empty($value)) {
        $this->attributes['job_position_end_date'] = null;
    } elseif ($value instanceof \DateTime) {
        $this->attributes['job_position_end_date'] = $value->format('Y-m-d');
    } else {
        // Try to parse date, fallback to null if invalid
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if ($date !== false) {
            $this->attributes['job_position_end_date'] = $date->format('Y-m-d');
        } else {
            $this->attributes['job_position_end_date'] = null; // or handle error
        }
    }
}

    /**
     * Set the id_issue_date.
     *
     * @param  string  $value
     * @return void
     */
   public function setIdIssueDateAttribute($value)
{
    if (empty($value)) {
        $this->attributes['id_issue_date'] = null;
    } elseif ($value instanceof \DateTime) {
        $this->attributes['id_issue_date'] = $value->format('Y-m-d');
    } else {
        // Try to parse date, fallback to null if invalid
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if ($date !== false) {
            $this->attributes['id_issue_date'] = $date->format('Y-m-d');
        } else {
            $this->attributes['id_issue_date'] = null; // or handle error
        }
    }
}


    /**
     * Set the id_expire_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setIdExpireDateAttribute($value)
    {
    if (empty($value)) {
        $this->attributes['id_expire_date'] = null;
    } elseif ($value instanceof \DateTime) {
        $this->attributes['id_expire_date'] = $value->format('Y-m-d');
    } else {
        // Try to parse date, fallback to null if invalid
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if ($date !== false) {
            $this->attributes['id_expire_date'] = $date->format('Y-m-d');
        } else {
            $this->attributes['id_expire_date'] = null; // or handle error
        }
    }
}

    /**
     * Get date_of_birth in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDateOfBirthAttribute($value)
     {
    return $value ? Carbon::parse($value)->format('Y-m-d') : null;
}
    

    /**
     * Get joined_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getJoinedDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
    

    /**
     * Get job_position_start_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getJobPositionStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    /**
     * Get job_position_end_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getJobPositionEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;

    }

    /**
     * Get id_issue_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getIdIssueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;

    }

    /**
     * Get id_expire_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getIdExpireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
    




}
