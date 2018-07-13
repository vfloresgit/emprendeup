<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEspecialidad extends Model
{
    //
    protected $table = 'users_especialidades';
    public $primaryKey="user_id";
    protected $fillable = [
            'user_id','idespecialidad'
     ];
   public $timestamps = false;
}
