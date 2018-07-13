<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $hidden = ['password'];

    protected $fillable = [
            'email','password','activity','start_up_id','persona_id','tipo_personas','rol_id'
     ];

}
