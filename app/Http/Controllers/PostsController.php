<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('listofposts', ['posts' => $posts]);
    }
    


      
    public function showpost($slug)
    {
        // Retrieve the post based on the slug
        $post = Post::where('slug', $slug)->first(); // Assuming you have an Eloquent model for posts named "Post"
    
        // Check if the post exists
        if (!$post) {
            abort(404); // Or handle the case when the post is not found
        }
    
        // Pass the post data to the view
        return view('showpost', ['post' => $post]);
    }

    public function destroy($id)
    {
        
        $post = Post::find($id);
        
        $post->delete();
        // return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        return to_route ('posts.index');
    }
    
    // function to create post
    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'title' => 'required',
        'body' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for the image field
    ]);

    // Handle the image file upload if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('postimages', 'public');
    } else {
        $imagePath = null;
    }

    // Create a new post
    Post::create([
        'title' => $request->input('title'),
        'body' => $request->input('body'),
        'image' => $imagePath,
       
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');

}
}