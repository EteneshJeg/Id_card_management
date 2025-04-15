<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityCardTemplateDetail extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'identity_card_template_details';

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
                    'identity_card_template_id',
                    'identity_card_detail_id'
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
     * Get the identityCardTemplate for this model.
     *
     * @return App\Models\IdentityCardTemplate
     */
    public function identityCardTemplate()
    {
        return $this->belongsTo('App\Models\IdentityCardTemplate','identity_card_template_id');
    }

    /**
     * Get the identityCardDetail for this model.
     *
     * @return App\Models\IdentityCardDetail
     */
    public function identityCardDetail()
    {
        return $this->belongsTo('App\Models\IdentityCardDetail','identity_card_detail_id');
    }



}
