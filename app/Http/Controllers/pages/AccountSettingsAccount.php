<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountSettingsAccount extends Controller
{
  public function index()
  {
    return view('content.pages.pages-account-settings-account');
  }


  public function update(Request $request)
  {
      // Get the current user
      $user = auth()->user();
  
      // Update the name and email fields
      $user->name = $request->input('firstName');
      $user->email = $request->input('email');
  
      // Check if an image was uploaded
      if ($request->hasFile('image')) {
          // Store the image in the 'public' disk under the 'avatars' directory
          $filename = $request->file('image')->store('avatars', 'public');
          // Save the image filename to the user's 'image' field
          $user->image = $filename;
      }
  
      // Save the changes
      $user->save();
  
      // Redirect back to the account settings page with a success message
      return redirect()->back()->with([
          'success'=> 'تم تحديث الملف الشخصي بنجاح',
        //  'myVarible'=> dd($user->image),
      ]);
  }
 
}
