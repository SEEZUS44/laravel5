<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function posts(){
    //function will help return table details
    return $this->hasManyThrough('App\Post', 'App\User', 'country_id');

    //He says because we using Post, we will bring it in, to find the user_id.
    //The country_id will be retrieved from the User
    //We finding the post related to the country then user_id [post - user - country] but we show the post
    //THe third parameter is to define the field you are looking for
    }  
}
