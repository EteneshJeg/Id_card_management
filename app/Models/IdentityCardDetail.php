<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentityCardDetail extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'identity_card_details';

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
                    'template_id',
                  'field_label',
                  'label_length',
                  'field_name',
                  'type',
                  'text_content',
                  'text_positionx',
                  'text_positiony',
                  'text_font_type',
                  'text_font_size',
                  'text_font_color',
                  'text_gap',
                  'image_file',
                  'image_width',
                  'image_height',
                  'has_mask',
                  'circle_mask_thickness',
                  'circle_diameter',
                  'circle_positionx',
                  'circle_positiony',
                  'circle_background',
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
