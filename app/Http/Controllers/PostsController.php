<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
//    function __construct(){
//     // $this->middleware('auth')->only(["store","showpost"]);
//     $this->middleware('auth')->except(["index","store"]);
//    }
    
    public function index()
    {
    
    $categories=Category::all();
    $users=User::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(6); // Retrieve 5 posts per page
        return view('posts.listofposts', ['posts' => $posts,'categories'=>$categories,'users'=>$users]);
    }


      
    public function showpost($slug)
       {
        $users=User::all();
        $categories=Category::all();
        // Retrieve the post based on the slug
        $post = Post::where('slug', $slug)->first(); // Assuming you have an Eloquent model for posts named "Post"

        // Check if the post exists
        if (!$post) {
            abort(404); // Or handle the case when the post is not found
                    }
    
        // Pass the post data to the view
        return view('posts.showpost', ['post' => $post,'categories' => $categories,'users'=>$users]);
    }
// function to delete post
    public function destroy($id)
    {
        if (Auth::user()->id === $post->user_id) {
        $post = Post::find($id);
        if ($post->image) {
            // Construct the full path to the image using the 'public' disk
            $imagePath = public_path('storage/' . $post->image);
    
            // Check if the image file exists before attempting to delete
            if (file_exists($imagePath)) {
                // Delete the image file
                unlink($imagePath);
            }
        }
        $post->delete();
        // return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        return to_route ('posts.index');}
    }
    
    // function to create post
    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'title' => 'required|min:3',
        'body' => 'required |min:10',
        'category_id' => 'required',
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
// dd($request);

    // Create a new post
    Post::create([
        'title' => $request->input('title'),
        'body' => $request->input('body'),
        'category_id' => $request->input('category_id'),
        'image' => $imagePath,
        'user_id'=>Auth::id()
       
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');

}

public function update(Request $request, $slug){
    $post = Post::where('slug', $slug)->first(); 

    if (!$post) {
        // Handle the case where the post is not found
        return redirect()->route('posts.index')->with('error', 'Post not found');
    }

    if (Auth::user()->id !== $post->user_id) {
abort(403)   ;
 }
  $request->validate([
    'title' => 'required|min:3',
    'body' => 'required |min:10',
    'category_id' => 'required',
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
$post->update([
    'title'=>$request->input('title'),
    'body'=>$request->input('body'),
    'category_id'=>$request->input('category_id'),
    'image'=>$imagePath,
    ]);
    return redirect()->route('showpost', ['slug' => $slug])->with('success', 'Post updated successfully.');
} }
