<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

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
                    'motto',
                    'mission',
                    'vision',
                    'core_value',
                    'logo',
                    'address',
                    'website',
                    'email',
                    'phone_number',
                    'fax_number',
                    'po_box',
                    'tin_number',
                    'abbreviation'
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
    



}
