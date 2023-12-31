<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeCategoryController;
use App\Http\Requests\updatCategoryController;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCategoryController $request)
    {
      
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logocategories', 'public');
        } else {
            $logoPath = null;
        }
    
        Category::create([
            'name' => $request->input('name'),
            'logo' => $logoPath,
            'user_id'=>Auth::id()
        ]);
        return redirect()->route('categories.index')->with('success', 'Post Category successfully.');

    }
    /**v
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));    

    }
    /** Update the specified resource in storage.
     */
    public function update(updatCategoryController $request, string $id)
    {
        $category = Category::find($id);
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logocategories', 'public');
        } else {
            $logoPath = null;
        }
        
        $category->update([
            'name' => $request->input('name'),
            'logo' => $logoPath,
        ]);
        return redirect()->route('categories.show', $category->id)->with('success', 'Post Category successfully.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $category = Category::find($id);
        if ($category->logo) {
            // Construct the full path to the image using the 'public' disk
            $imagePath = public_path('storage/' . $category->logo);
    
            // Check if the image file exists before attempting to delete
            if (file_exists($imagePath)) {
                // Delete the image file
                unlink($imagePath);
            }}
        $category->delete();
        return redirect()->route('categories.index');

    }
}
