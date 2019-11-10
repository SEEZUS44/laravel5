<?php

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

// use Illuminate\Support\Facades\Route;

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

DB::insert('insert into posts(title, content) values(?,?)',['PHP with Laravel', 'Laravel so cool best best for PHP']);

});

Route::get('/read', function(){

   $results = DB::select('select * from posts where id =?', [1]);

   foreach($results as $posts){

    return $posts->content;
   }
});