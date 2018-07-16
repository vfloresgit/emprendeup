<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAvance extends Model
{
    //

    protected $table = 'nivel_avance';
    protected $primaryKey = 'nivel_avance_id';
    protected $fillable = [
        'estado_activo','niveles_de_avance_id','start_ups_start_up_id'
    ];
}
