<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEspecialidad extends Model
{
    //
    protected $table = 'users_especialidades';
    protected $fillable = [
            'user_id','idespecialidad'
     ];
}
