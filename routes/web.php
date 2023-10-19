<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/listofposts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/listofposts/showpost/{slug}', [PostsController::class, 'showpost'])->name('showpost');
Route::get('/listofposts/showpost/delete/{id}', [PostsController::class, 'destroy'])->name('showpost.delete');

Route::post('/listofposts', [PostsController::class, 'store'])->name('posts.store');
Route::put('//listofposts/showpost/{slug}', [PostsController::class, 'update'])->name('showpost.updatepost');


//______________________categories routes_________________
Route::resource('categories', CategoryController::class);