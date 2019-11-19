<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content'
    ];
    /*Basically the section uptop does the following:
    
    Inherit from the Model Class.
    But because default setting is to add an s then becomes table for e.g. if Model is named Flight the table would be named flights.
    Rename the table to work with 'post' & the primary key IS id

    After that, to allow the mass assignments (basically inserts ) onto the table you create the fillable aspect with the array.
    */

    protected $dates = ['deleted_at'];

    public function user(){

        return $this->belongsTo('App\User');
        //this will be one to one
        //creates an inverse relationship to Users (you do not need this for the one to one to work)
        //The setting in the User table is fine
    }

}
