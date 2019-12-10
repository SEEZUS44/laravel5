@extends('layouts.app')

@section('content')

    <h1>EDIT POST</h1>
    
    <form method="post" action="/posts/{{$post->id}}">
    {{-- The above stpulates the method that'll be used by the form. --}}
    {{-- using the artisan routes created --}}
    {{-- you then access the method posts store which is in PostsController@store --}}

    {{-- UPDATE
    the /$post->id is added as this is the value that will be passed into the URL to allow you to see x item in the db row. --}}
    
    {{csrf_field()}}
    {{-- //this is to create the token --}}

    <input type="hidden" name="_method" value="PUT">
    {{--run the php artisan list, you'll see that under method there's get|head, put|patch etc.
    We're defining something similar here 
         --}}

    <input type="text" name="title" placeholder="Enter Title:" value="{{$post->title}}">
    {{csrf_field()}}
    <input type="submit" value="UPDATE">
    {{-- Most of the inner workings are within the PostsController
        Which is linked via Route::resource('posts', 'PostsController');
        Which calls the posts create
        ***NOT SURE AT THIS MOMENT THE TRUE TIE UP BUT THIS JUST MIGHT BE ALL
        --}}

        {{-- DELETE SECTION --}}

    <form method= "post" action="/posts/{{$post->id}}">
    
        <input type="hidden" name="_method" value="DELETE">

        <input type="submit" value="DELETE">

    </form>
</form>
@endsection