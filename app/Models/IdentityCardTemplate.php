<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityCardTemplate extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'identity_card_templates';

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
                    'type',
                    'file',
                    'sample_file',
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
    



}
