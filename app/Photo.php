<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public function image(){
    return $this->morphTo();
    //Polymorph config
    //The morph items were added to Post & Users
    }


}
