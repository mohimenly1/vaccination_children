<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
  {
      $value = $request->input('email-username');
      $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  
      $request->validate([
          'email-username' => 'required|string',
          'password' => 'required|string',
      ], [
          'email-username.required' => 'يرجى إدخال البريد الإلكتروني او إسم المستخدم',
          'password.required' => 'يرجى إدخال كلمة المرور',
      ]);
  
      // Check if user exists
      $user = User::where($field, $value)->first();
      if (!$user) {
          return redirect()->back()->withErrors([
              'login' => 'تأكد من كلمة المرور و مُعرفك او بريدك',
          ]);
      }
  
      $credentials = [
          $field => $value,
          'password' => $request->input('password'),
      ];
  
      if (Auth::attempt($credentials)) {
        if ($user->isActive()) {
            // Authentication passed and user account is active
            return redirect()->intended('/')->with('user', $user);
        } else {
            // User account is not active
            return redirect()->back()->withErrors([
                'login' => 'هذا الحساب غير مُفعل، يرجى المحاولة لاحقاً',
            ]);
        }
    } else {
        // Authentication failed
        return redirect()->back()->withErrors([
            'login' => 'تأكد من كلمة المرور و مُعرفك او بريدك',
        ]);
    }
    
    
  
      // Authentication failed or user account is inactive
      return redirect()->back()->withErrors([
          'login' => 'Invalid email/username or password',
      ]);
  }
  
  

  public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->to(url('/auth/login-basic'));
}
  

}
