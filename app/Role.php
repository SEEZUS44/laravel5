<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    
    protected $fillable = [

        'user_id',

    ];
    public function users(){
        return $this->belongsToMany('App\User');
        //this will be one to one
        //creates an inverse relationship again

    }
}
