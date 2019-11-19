<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function users(){

        return $this->belongsToMany('App\User');
        //this will be one to one
        //creates an inverse relationship again

    }
}
