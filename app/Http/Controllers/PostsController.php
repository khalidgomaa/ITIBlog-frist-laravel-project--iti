<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
  
  private  $posts = [
        ["id" => 1, "title" => "Post 1", "content" => "Content 1"],
        ["id" => 2, "title" => "Post 2", "content" => "Content 2"],
        ["id" => 3, "title" => "Post 3", "content" => "Content 3"],
        ["id" => 4, "title" => "Post 4", "content" => "Content 4"],
    ];

    public function showallposts() {
        return view('allposts', ['posts' => $this->posts]);
    }
      
    public function showpost($id) {
        // Find the Post with the given ID in the $posts array
        $post = null;
        foreach ($this->posts as $p) {
            if ($p['id'] == $id) {
                $post = $p;
                break;
            }
        }
    
        // If the Post with the given ID is found, pass the Post data to the view
        if ($post) {
            return view('showpost', ['post' => $post]);
        }
    
        // If the Post with the given ID is not found, return a 404 response
        abort(404);
    }
    
}
