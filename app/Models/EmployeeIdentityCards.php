<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeIdentityCards extends Model
{
    //

   
  protected $table='employee_identity_cards';

  protected $primaryKey='id';

  protected $fillable=[
    'employee_id',
    'identity_card_template_id',
    'image_file'
  ];

  protected $dates=[];

  protected $casts=[];

}
