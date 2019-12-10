<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "I am the create method!";
        return view('posts.create');

        //the above access the create layout created.
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Receives the super value via the $request object
        // return $request->all(); this returns the thingy - look it up 
        //return $request->get('title');will return the entered value
        // return $request->title;//like all() but returns 1

        //adding data to the datatable
        // Post::create($request->all());

        //Another way
        // $input = $request->all();

        // $input['title'] = $request->title;

        // Another another way
        $post = new Post;

        $post->title = $request->title;

        $post->save();

        return redirect('/posts');   

        /* 
        THE BEST WAY IS DEPENDENT ON WHATEVER YOU ARE BUILDING
        EDWIN SUGGESTS THE ONE WITH LESS AMT OF LINES
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));

        //This is to show the individual post.
        //You retrieve the post id from the url this is thrown in as a parameter
        //Return then the posts.show - the compact helps create the array with variable names and their 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $post = Post::findOrFail($id);

         return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // return $request->all(); this is to test that the round trip 
        // between controller & view & the data transimission works
        // Below is the actual data transfer & view then update
        $post = Post::findOrFail($id);

        $post->update($request->all());
        //the line here updates all for the $id thrown in 

        // return redirect('post.index'); wrong way of doing it
        return redirect('/posts');
        //redirect the browser to the index once the above is complete
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/posts');

        // $post = Post::whereId($id)->delete();
        // Or this
    }

    public function contact(){
        
        $people = ['Jose', 'Peter', 'Maria', 'Gary'];

        return view('contact', compact('people'));
    }

    public function show_post($id, $password, $test){

        // return view('post')->with('id',$id);
        return view('post', compact('id','password','test'));
    }
}
