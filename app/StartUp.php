<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartUp extends Model
{
    //
   protected $table = 'startup';
   protected $primaryKey = 'start_up_id';

   protected $fillable = [
        'name', 'foundation_year','email','phone','web_page','industry_sector','product_type','product_details','departamento_id','province_id','district_id','fecha_inicio','fecha_inicio_historico'
    ];

}
