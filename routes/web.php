<?php

use App\Post;
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

// use Symfony\Component\Routing\Route;

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

DB::insert('insert into post(title, content) values(?,?)',['PHP with Laravel', 'Laravel so cool best best for PHP']);

});

Route::get('/read', function(){

   $results = DB::select('select * from post where id =?', [1]);

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
|ELOQUENT
|-------------------------------------------------------------
*/

Route::get('/find', function (){

    $posts = Post::all();

    foreach ($posts as $post)

    return $post->title;

});