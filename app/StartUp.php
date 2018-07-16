<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartUp extends Model
{
    //
   protected $table = 'startup';
   protected $primaryKey = 'id';

   protected $fillable = [
        'name', 'foundation_year','email','phone','web_page','industry_sector','especificar','product_type','product_details','tiempo','cambio_fase','activity','fecha_inicio','fecha_inicio_historico','users_user_id','departamento_id','province_id','district_id','pasos'
    ];

}
