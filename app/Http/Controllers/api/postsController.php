<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
     // Handle the image file upload if provided
     if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('postimages', 'public');
        $post->image = $imagePath;
    }
    
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    $post->category_id = $request->input('category_id');
    
    $post->save();

    return $post; // Return the updated post
}
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Post $post)
{
    // Handle the image file upload if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('postimages', 'public');
        $post->image = $imagePath;
    }
    
    $post->update([
        'title'=>$request->input('title'),
        'body'=>$request->input('body'),
        'category_id'=>$request->input('category_id'),
        'image'=>$imagePath,
        ]);
    return $post;
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        
        $posts=Post::all();
        return $posts;
    }
}
