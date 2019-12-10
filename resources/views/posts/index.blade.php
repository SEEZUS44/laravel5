@extends('layouts.app')

@section('content')
    <h1><a href="{{route('posts.create')}}"> Create Post</a></h1>
    <ul>

        @foreach ($posts as $post)
         
         <li><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></li>   
        {{-- According to Edwin:

            so ul is unordered bulleted list (Google)
            @foreach loops through all the array items returned
            li is the list item

            a href creates a link for each of the bracketed items
            posts.show links to the view show.blade.php [which says display the title of x post]
            $post->id is the id that MUST be passed in for the url to look like cms.bb/posts/x
            Then this

            $post->title is the actual listed items read from the DB and listed.

         --}}
        @endforeach
    </ul>

@endsection