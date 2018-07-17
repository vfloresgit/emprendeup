<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    //
    protected $table = 'fase';
    protected $primaryKey = 'id';

    protected $fillable = [
        'inicio','cantidad_meses','fin','estado_activo'
    ];
}
