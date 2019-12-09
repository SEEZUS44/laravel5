@extends('layouts.app')

@section('content')

<form method="post" action="/posts">
    {{-- The above stpulates the method that'll be used by the form. --}}
    {{-- using the artisan routes created --}}
    {{-- you then access the method posts store which is in PostsController@store --}}

    <input type="text" name="title" placeholder="Enter Title:">
    {{csrf_field()}}
    <input type="submit" value="submit">
    {{-- Most of the inner workings are within the PostsController
        Which is linked via Route::resource('posts', 'PostsController');
        Which calls the posts create
        ***NOT SURE AT THIS MOMENT THE TRUE TIE UP BUT THIS JUST MIGHT BE ALL
        --}}
</form>
@endsection