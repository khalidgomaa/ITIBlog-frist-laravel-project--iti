<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
class PostsController extends Controller
{
    // public function index()
    // {
    //     // $posts = Post::all();
    //     $posts = Post::paginate(5); // Retrieve 5 posts per page
    //     return view('listofposts', ['posts' => $posts]);
    // }
    
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6); // Retrieve 5 posts per page
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
// function to delete post
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
        'title' => 'required|min:3',
        'body' => 'required |min:10',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for the image field
      ],
      [
        "title.required"=>"your title is required",
        "title.min"=>"your title must be more 3 charachters",
       "body.required"=>"your body is required",
       "body.min"=>"your body must be more 10 charachters",
       "image.required"=>"your image is required",
       "image.image"=>"your file must be image",
       "image.mimes"=>"your image must be jpeg,png,jpg or gif",
       "image.max"=>"your image must in size 2048"
        
       
      ]
    
    );

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

public function update(Request $request, $slug){

    
  // Validate the form data
  $request->validate([
    'title' => 'required|min:3',
    'body' => 'required |min:10',
    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for the image field
  ],
  [
    "title.required"=>"your title is required",
    "title.min"=>"your title must be more 3 charachters",
   "body.required"=>"your body is required",
   "body.min"=>"your body must be more 10 charachters",
 
   "image.image"=>"your file must be image",
   "image.mimes"=>"your image must be jpeg,png,jpg or gif",
   "image.max"=>"your image must in size 2048"
    
   
  ]

);
   // Handle the image file upload if provided
   if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('postimages', 'public');
} else {
    $imagePath = null;
}
// Update an existing post
$post = Post::where('slug', $slug)->first(); 
$post->pduate([
    'title'=>$request->input('title'),
    'body'=>$request->input('body'),
    'image'=>$imagePath,
    ]);
    return redirect()->route('showpost', ['slug' => $slug])->with('success', 'Post updated successfully.');
} 
}