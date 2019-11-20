<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post(){

        return $this->hasOne('App\Post');
        //Will go to Post table & look for User_id by default but if you want to go to a certain
        //hasOne relationship with Post
    }
    
    public function posts(){
        return $this->hasMany('App\Post');
        //hasMany relationships with Post
    }

    public function roles(){

        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withPivot('created_at', 'updated_at');

        /*CUSTOMIZATION OF THE DIFFERENT TABLES (if we used a different table)
        'role_user', custom name for the pivot table
        'user_id', FK of the user table
        'role_id', FK of the roles table

        
        withPivot defines that these are the columns that you want to return
        */
    }

    public function photos(){
        return $this->morphMany('App\Photo', 'image');
        //Polymorph config
        //the same in Post model
        }

}
