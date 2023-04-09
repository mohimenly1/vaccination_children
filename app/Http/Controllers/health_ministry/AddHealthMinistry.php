<?php

namespace App\Http\Controllers\health_ministry;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddHealthMinistry extends Controller{


        public function create()
        {
            return view('content.pages.health-ministry.add-health-center');
        }


        public function store(Request $request)
        {
            // Validate the form data
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required|min:8',
            ],[
                'name.required' => 'إسم المركز الصحي مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.unique' => 'البريد الإلكتروني موجود بالفعل',
                'username.required' => 'إسم المستخدم مطلوب',
                'username.unique' => 'إسم المستخدم موجود بالفعل',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب أن تكون اكثر من 8 ارقام'
            ]);
            // Create the new user with the 'users_health_center' role
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->username = $validatedData['username'];
            $user->password = Hash::make($validatedData['password']);
            $user->role = 'users_health_center';
            $user->save();
    
            // Check if the user adding the new user has the 'users_health_ministry' role
            if (Auth::user()->role == 'users_health_ministry') {
                // Do something if the user has the 'users_health_ministry' role
            }
    
            return redirect()->route('dashboard-analytics');
        }
}