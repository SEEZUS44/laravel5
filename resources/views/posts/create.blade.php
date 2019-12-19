@extends('layouts.app')


@section('content')

    <h1>Create post</h1>
    {{-- <form method="post" action="/posts"> --}}
    {{-- The above stpulates the method that'll be used by the form. --}}
    {{-- using the artisan routes created --}}
    {{-- you then access the method posts store which is in PostsController@store --}}


         {!! Form::open(['method' => 'POST','action' => 'PostsController@store', 'files'=>true]) !!}

        {{-- This requires require laravel/collection in the composer.json & an addition of entries within the config/app 
             '--}}

        {{-- array added within to define it, look at the line 06 code 
            It basically reads, this is a post form & uses the store methid in the PostsController
        
        the files=>true allows files to be uploaded.
        
            --}}


        <div class="form-group">

        {!! Form::label('title', 'Title:')!!}
        {!! Form::text('title', null, ['class'=>'form-control'])!!}

        </div>

        <div class="form-group">
            {!! Form::file('file', ['class'=>'form-control'])!!}    
        </div>
        {{-- The above is for the file upload button --}}

        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}

        {{-- HTML BELOW AND FORM PACAGE FUNCTIONALITY ABOVE --}}

        {{-- <input type="text" name="title" placeholder="Enter Title">

        {{-- {{csrf_field()}} --}}
        {{-- <input type="submit" value="submit"> --}}
        {{--  
            Most of the inner workings are within the PostsController
            Which is linked via Route::resource('posts', 'PostsController');
            Which calls the posts create
            ***NOT SURE AT THIS MOMENT THE TRUE TIE UP BUT THIS JUST MIGHT BE ALL

            RUN ARTISAN LIST COMMAND TO SEE THE LISTS WITH RELATION TO THE VIEW AND CONTROLLER
            --}}

            {!!Form::close()!!}

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)

                            <li>{{$error}}</li>
                            
                        @endforeach

                    </ul>

                </div>
            @endif
@endsection