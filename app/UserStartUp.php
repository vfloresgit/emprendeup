<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStartUp extends Model
{
    //
    protected $table = 'user_startup';

    protected $fillable = [
            'user_id','startup_id'
     ];


}
