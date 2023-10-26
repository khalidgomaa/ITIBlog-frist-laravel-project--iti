<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
    return view('home');
});

Route::get('/listofposts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/listofposts/showpost/{slug}', [PostsController::class, 'showpost'])->name('showpost')->middleware('auth');
Route::get('/listofposts/showpost/delete/{id}', [PostsController::class, 'destroy'])->name('showpost.delete');

Route::post('/listofposts', [PostsController::class, 'store'])->name('posts.store');
Route::put('//listofposts/showpost/{slug}', [PostsController::class, 'update'])->name('showpost.updatepost');


//______________________categories routes_________________
Route::resource('categories', CategoryController::class);
Route::resource('users', userController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//______________________________ routes for user profile_______________
Route::prefix('myprofile')->middleware('auth')->group(function () {
    Route::get('/myProfile', [UserProfileController::class, 'show'])->name('profile');
    Route::patch('update', [UserProfileController::class, 'update'])->name('myprofile.update');
    Route::delete('delete', [UserProfileController::class, 'destroy'])->name('myprofile.delete');
});
