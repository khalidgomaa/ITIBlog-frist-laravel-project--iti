<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

Route::get('/', function () {
    return view('home');
});

Route::get('/listofposts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/allposts/showpost/{slug}', [PostsController::class, 'showpost'])->name('showpost');
Route::get('/allposts/showpost/delete/{id}', [PostsController::class, 'destroy'])->name('showpost.delete');

Route::post('/listofposts', [PostsController::class, 'store'])->name('posts.store');
