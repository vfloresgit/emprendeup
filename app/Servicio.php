<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    protected $table = 'servicio';
    protected $primaryKey = 'id';

    protected $fillable = ['descripcion','servicio_tipo'];
}
