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
            'email','password','activity','start_up_id','persona_id','tipo_personas','category'
     ];
     
    public function startups(){
    return $this->belongsToMany('App\StartUp','user_startup','user_id','start_up_id');
    // ->withPivot('url');
    }

    public function persona(){
       return $this->belongsTo('App\Persona','persona_id','user_id');
    }



    // Task model


 

}
