<?php

namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddParentFile extends Controller
{



  public function store(Request $request)
  {

  
      $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'date_birth_parent' => 'required|date',
          'national_number_parent' => 'required|string|size:12|unique:users,national_number_parent',
          'ssn' => 'required|string|size:5|unique:users,ssn',
          'phone_number' => 'required|string',
          'address' => 'required|string',
          'email' => 'required|email|unique:users',
          'username' => 'required|unique:users',
          'password' => 'required|min:8',
      ], [
          'name.required' => 'يجب إدخال اسم ولي الأمر',
          'date_birth_parent.required' => 'يجب إدخال مواليد ولي الأمر',
          'address.required' => 'يجب إدخال العنوان',
          'phone_number.required' => 'يجب إدخال رقم الهاتف',
          'ssn.required' => 'يجب إدخال رقم ورقة العائلة',
          'ssn.numeric' => 'يجب إدخال رقم ورقة العائلة بالارقام فقط',
          'ssn.size' => 'يجب ان يتكون من 5 رقم',
          'ssn.unique' => 'هذا الرقم مستخدم بالفعل',
          'national_number_parent.required' => 'يجب إدخال الرقم الوطني',
          'national_number_parent.numeric' => 'يجب إدخال الرقم الوطني بالأرقام فقط',
          'national_number_parent.size' => 'يجب أن يتكون الرقم الوطني من 12 رقماً',
          'national_number_parent.unique' => 'هذا الرقم الوطني مستخدم بالفعل',

          'name.required' => 'إسم المركز الصحي مطلوب',
          'email.required' => 'البريد الإلكتروني مطلوب',
          'email.unique' => 'البريد الإلكتروني موجود بالفعل',
          'username.required' => 'إسم المستخدم مطلوب',
          'username.unique' => 'إسم المستخدم موجود بالفعل',
          'password.required' => 'كلمة المرور مطلوبة',
          'password.min' => 'كلمة المرور يجب أن تكون اكثر من 8 ارقام'
      ]);
      Log::info('Validated data:', $validatedData);

      // Perform validation
      if ($request->fails()) {
        // If validation fails, return back with errors
        return redirect()->back()->withErrors($request->errors())->withInput();
    }
 
      
        // Create the new user with the 'parent' role
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 'parent';
        $user->save();

        // Add additional parent information to the user record
        $user->birth_date_parent = $validatedData['birth_date_parent'];
        $user->national_number_parent = $validatedData['national_number_parent'];
        $user->phone_number = $validatedData['phone_number'];
        $user->address = $validatedData['address'];
        $user->ssn = $validatedData['ssn'];
        $user->save();

        // Redirect back or to a specific route after storing
        return redirect()->route('dashboard-analytics')->with('success', 'Parent added successfully.');

  }
  


  
}
