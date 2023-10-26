<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class UserProfileController extends Controller
{
  function show (){
    $user = Auth::user();
    return view('auth.myProfile', compact('user')); 
 }
 public function update(Request $request)
 {
     $user = Auth::user();
 
     // Validate the form data
     $request->validate([
         'name' => 'required|string|max:255',
         'old_password' => 'required|string',
         'password' => 'nullable|string|min:8|confirmed', // 'confirmed' checks for password_confirmation field
     ]);
 
     // Verify the old password
     if (!Hash::check($request->input('old_password'), $user->password)) {
         return redirect()->route('profile')->with('error', 'Incorrect old password');
     }
 
     // Update user's profile
     $user->name = $request->input('name');
     $user->email = $request->input('email');
 
     // Check if a new password is provided
     if ($request->filled('password')) {
         $user->password = Hash::make($request->input('password'));
     }
 
     $user->save();
 
     return redirect()->route('profile')->with('success', 'Profile updated successfully');
 }

}
