<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    //
     protected $table = 'meses';
    protected $primaryKey = 'idmes';

    protected $fillable = [
        'month_id', 'year_id','tipo_mes','startup_id','estado_activo','fase_id',
    ];
    public $timestamps=false;
}
