<?php

use App\Country;
use App\Post;
use App\User;
use App\Role;
use App\Photo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'Hello!';
});

Route::get('admin/posts/', function(){
    return 'Testing 123';
});

Route::resource('posts', 'PostsController');

Route::get('/contact', 'PostsController@contact');

Route::get('/post/{id}/{password}/{name}', 'PostsController@show_post');

// Route::get('/post/{num1}', function($num1){
//     return "this is number ".$num1;
// });

Route::get('/insert', function(){

DB::insert('insert into posts(title, user_id, content, is_admin) values(?,?,?,?)',['PHP with Laravel', '1', 'Laravel so cool best best for PHP','0']);

});

Route::get('/insertUser', function(){

    DB::insert('insert into users(name, email, password) values(?,?,?)',['Sizwe K', 'sizwet@test.com', 'LaravelSoCoolBestBestForPHP']);
    
    });

Route::get('/read', function(){

   $results = DB::select('select * from post', [1]);

   foreach($results as $posts){

    // return $posts->content;
    return $posts->title;
   }
});

Route::get('/update', function(){

    $updated = DB::update('update post set title = "Update title" where id = ?', [1]);

    return $updated;

});

Route::get('/del', function (){

    $deleted = DB::delete('delete from post where id = ?', [1]);

});

/*
|-------------------------------------------------------------
|ELOQUENT - RETRIEVE
|-------------------------------------------------------------
*/

Route::get('/find', function(){
    
    // $posts = Post::all();

    // foreach($posts as $post){

    //     echo $post->content;
    // }

    $post = Post::find(1);
    return $post->content;
    //  foreach($post as $poster){
    //     return $poster->content;
    // }

});

/*
|-------------------------------------------------------------
|ELOQUENT - RETRIEVE WITH WHERE
|-------------------------------------------------------------
*/

Route::get('/findWhr', function(){

    $post = Post::where('id', 1)->orderBy('id', 'desc')->get();

    return $post;

});

Route::get('/findMore', function(){

    // $posts = Post::findOrFail(2);
    // return $posts;

    // $post=Builder::where('users_count', '<', 50)->findOrfFail();
});

/*
|-------------------------------------------------------------
|ELOQUENT - INSERTING DATA
|-------------------------------------------------------------
*/

Route::get('/basicInsert', function(){

    $post = new Post;

    $post->title = 'newORM title';
    $post->content = 'This my new content';

    $post->save();
});

//The below is the basic, difference is the call to the Model Post with an addition of the class
Route::get('/saveUpdate', function(){

    $post = Post::find(2);

    $post->title = 'newORM title';
    $post->content = 'This my new content';

    $post->save();
});

//CREATING DATA

Route::get('/create', function(){

    Post::create(['title'=>'the create method', 'content'=>'Wow \'such learning WOW']);
    //
});

/*
|-------------------------------------------------------------
|ELOQUENT - UPDATING DATA
|-------------------------------------------------------------
*/

Route::get('/update', function(){

    Post::where('id', 2)->update(['title'=>'New PHP Title', 'content'=>'Edwin a G']);
    /*
    The statement above reads as 'where the id is 2, update the title to be New PHP Title, content to be Edwin a G.
    */
});

/*
|-------------------------------------------------------------
|ELOQUENT - DELETING DATA
|-------------------------------------------------------------
*/

Route::get('/delete', function(){

    $post = Post::find(2);

    $post->delete();

});

Route::get('/destroy', function(){

    Post::destroy(3);
    
    // Post::destroy([4,5]);//for multiple

    // Post::where('id', 4)->delete();//via where
});
//We have to read up on the difference here between delete() & destroy()

/*
|-------------------------------------------------------------
|ELOQUENT - TRASHING (SOFT DELETE)
|
|The section below allows for recoverable deletes.abnf
|The first step is to add an additional column via migrate via command: php artisan make:migration add_deleted_at_column_to_posts_tables --table=post
|Once complete, then you add the items within the created file to let it know that you are ceating soft deletes & you can 'drop the table'
|In the lecture he comes back here to continue with creating the route
|
|If we have any issues Migrate-Reset can resolve it
|-------------------------------------------------------------
*/

Route::get('/softDel', function(){

    Post::find(6)->delete();

});

//RETRIEVING DELETED DATA

Route::get('/readSoftDel', function(){

    // $post=Post::find(6);
    // return $post;

    // $post=Post::withTrashed()->where('id',7)->get();

    // return $post;

    $post=Post::onlyTrashed()->get();
    //retrieving all
    return $post;
});

//RESTORING DELETED DATA
Route::get('/restore', function(){

    Post::withTrashed()->where('id', 6)->restore();

});

//PERMANENT DELETE
Route::get('/permaDel', function(){

    Route::withTrashed()->where('id', 7)->forceDelete();

});

/*
|-------------------------------------------------------------
|ELOQUENT - Relationsips - 1 to 1
|
|These relationships are acieved by creating hasOne, hasMany, belongsToMany within the Model and refer to the App\ModelName
|This then allows you to call said object within the view below & refer to the data as objs within the below view functions
|create table mode -> define columns -> open other model, create the hasMany for e.g. -> create view to call the data via the id
|
|In short, you define the database table to have the FK field in it. The within the models you create a function with another models name
|So if you connecting cutomer to orders, customer will be 1 (told it has one) & then orders will have cust id then a belongsTo/hasMany
|then you would create the respective function with the right return $this->hasMany (for e.g.) within the other Model.
|Have a look at the below examples to flesh out these words.
|-------------------------------------------------------------
*/

// Route::get('/user', function(){
//     $id=1;
//     $post = User::find($id);
//     // return $post;

//     // return User::find($id)->post;

//     return $post->name;
    
// }); Trying to troubleshoot the below.

Route::get('/user/{id}/post', function($id){

    return User::find($id)->post;
    /*
    In short, you pass the id then you state that using the User model
    Find the same id within the Post model table.

    This in turn will be the one-to-one relationship

    MUST BE SET UP IN THE POST MODEL (as a public function)
    */
});

Route::get('/post/{id}/user', function($id){

    return Post::find($id)->user->name;
    /*
    Same as above, using the Post model use the id &
    look for the id within and return the user table name with the same id

    This in turn will be the inverse one-to-one relationship

    MUST BE SET UP IN THE USER MODEL (as a public function)
    */
});

/*
|-------------------------------------------------------------
|ELOQUENT - Relationsips - One to Many
|-------------------------------------------------------------
*/

Route::get('/posts', function(){

    $user = User::find(1);

    foreach($user->posts as $post){

        echo $post->title."<br>";
        //echo will almost go through the array & echo it each time
        //return will literally return one entry & not display the resulting array entries
        //Sizwe Thoughts: It could be because echo hits directly to the html tags while the return 
    }
});

/*
|-------------------------------------------------------------
|ELOQUENT - Relationsips - Many to Many
|
|We will be creating a Pivot table which looks at other tables
|-------------------------------------------------------------
*/

Route::get('/returnUser/{id}/role', function($id){

    $user = User::find($id);

    foreach($user->roles as $role){

        return $role->name;
        /*
        The relationship is added onto the User Model with the text return $this->belongsToMany('App\Role');
        This allows laravel to know that the tables have a multiple relations with other tables with the tag 'belongsToMany'.
         */
    }
});

//QUERYING INTERMEDIATE TABLE (the pivot/lookup table that joins the Roles & Users)
Route::get('/user/pivot', function(){

    $user = User::find(1);

    foreach($user->roles as $role)

    return $role->pivot->created_at;
});

//HAS MANY THROUGH RELATIONSHIP - PART 1
//Accessing data via the intermediary table
//HAS MANY THROUGH - PART 2
//Please see Country Model for more details

Route::get('/user/country', function(){

    $country = Country::find(4);

    foreach($country->posts as $post){
        return $post->title;
    }

});
//A new column was added to the users - country id
//he defined this as an integer within the migration file
//A migration was created for this & the users in the same table were updated to have the corresponding id
//countries was populated with dummy details & 'linked' to users. 

//POLYMORPHIC RELATIONS PART1

//He made the table & added a tag -m during the make:model part
//Users & Post are related to photos for e.g. 
//me.jpg exists in users with id 1 & post with id 4

//POLYMORPHIC RELATIONS PART2
//he added App\ModelName within the photos table
//then he went to Photo, Posts & User to cofig the model
Route::get('/user/photos', function(){
    
    $user = User::find(1);

    foreach($user->photos as $photo){

        return $photo->path;
    }

});

//via photos
//multiple
Route::get('/post/photos', function(){
    
    $post = post::find(1);

    foreach($post->photos as $photo){

        echo $photo->path."<br>";
    }
    //This post then has all the pictures with the respective photos as per the db having x here & x there
});

//The below allows you to dynamically take in a variable
Route::get('/post/{id}/photos', function($id){
    
    $post = post::find($id);

    foreach($post->photos as $photo){

        echo $photo->path."<br>";
    }
});

//POLYMORPHIC BUT THE INVERSE

Route::get('/photo/{id}/post', function($id){

    $photo = Photo::findOrFail($id);
    //find or fail throws back an error message as to why it failed

    return $photo->image;
    //image is the primary id
    //tbh it makes sense but eish go back and forth between the Models
    //Seems like the answers are there 
});

//MANY TO MANY POLYMORPHIC RELATIONSHIP
//Share a list of details with other tables
//

Route::get('post/tag', function(){

    $post = Post::find(1);

    foreach($post->tags as $tag){
        
    echo $tag->name;

    }
});