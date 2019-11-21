<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts(){

        return $this->morphedByMany('App\Post', 'taggable');
        //we saying here 'HEY! THE POST WANTS YOU! Edwin's words.
        //Morphed by many is creating a relationship of many to many with other models

    }

    public function videos()
    {
        return $this->morphedByMany('App\Video', 'taggable');
        //same as above really
    }
}
