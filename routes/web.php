<?php

use App\Post;
use App\User;
use App\Role;
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
Route::get('user/pivot', function(){

    $user = User::find(1);

    foreach($user->roles as $role)

    return $role->pivot->created_at;
});