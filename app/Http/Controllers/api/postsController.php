<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        return PostResource::collection( $posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|string|max:255|min:3
            ',
            'body' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
        ];
    
        // Custom error messages
        $messages = [
            'image.mimes' => 'The image must be a valid format (jpeg, png, jpg, gif).',
            'image.max' => 'The image may not be larger than 2MB.',
        ];
    
        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
     // Handle the image file upload if provided
     if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('postimages', 'public');
        $post->image = $imagePath;
    }
    
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    $post->category_id = $request->input('category_id');
    $post->save();

    return new PostResource($post);    // Return the updated post
}
    // show function
    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        $rules = [
            'title' => 'required|string|max:255|min:3
            ',
            'body' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example image validation
        ];
    
        // Custom error messages
        $messages = [
            'image.mimes' => 'The image must be a valid format (jpeg, png, jpg, gif).',
            'image.max' => 'The image may not be larger than 2MB.',
        ];
    
        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // Handle the image file upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('postimages', 'public');
            $post->image = $imagePath;
        }
    
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->save();
    
        return new PostResource($post);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        
        $posts=Post::all();
        return PostResource::collection( $posts);
    }
}
