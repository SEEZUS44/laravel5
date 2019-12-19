<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{


    protected $primaryKey = 'id';

    protected $fillable = [

        'user_id',
        'title',
        'content',
        'is_admin',
        'created_at',
        'updated_at',
    ];
    /*Basically the section uptop does the following:
    
    Inherit from the Model Class.
    But because default setting is to add an s then becomes table for e.g. if Model is named Flight the table would be named flights.
    Rename the table to work with 'post' & the primary key IS id

    After that, to allow the mass assignments (basically inserts ) onto the table you create the fillable aspect with the array.
    */

    public function user(){

        return $this->belongsTo('App\User');
        //this will be one to one
        //creates an inverse relationship to Users (you do not need this for the one to one to work)
        //The setting in the User table is fine
    }

    public function photos(){

        return $this->morphMany('App\Photo', 'image');
        //Polymorph config
        //the same in the Users model
        }

    public function tags(){

        return $this->morphToMany('App\Tag', 'taggable');
        // Morphing to many and communicating to the tag model
    }

    public function scopeLatest($query){

        return $query->orderBy('id', 'asc');
        //over here this was the scope lesson where he defined the scope of the 'query' and plugged it next to an instance of a model
        //Please see the index function to see
    
        //So the index should have been $post = Post::all() then he changed it up to get ID and order by it ascending then get it.
        //He then compressed this into a variable and then wala it shows.

        // Query Scope
        /*
        A way to reduce the size of a lengthy query

        MUST BE WRITTEN AS 'SCOPE' and then you reference it by latest in the controller 
        Example: $post = Post::latest()->get()
        */

    }
}
