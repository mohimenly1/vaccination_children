<?php

namespace App\Http\Controllers\health_ministry;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class AddHealthMinistry extends Controller{

    public function sendSms(Request $request)
    {
        // Replace these values with your Twilio credentials
        $sid = "AC1e81dcdb9e1fdd9b8ca7fbb3e43c9f01";
        $token = "81b93458a932f9825abcb10d8c4bdd95";
        $twilioPhoneNumber = "+15642148510"; // Your Twilio phone number

        $twilio = new Client($sid, $token);

        $to = $request->input('to');
        $messageBody = $request->input('message');

        try {
            $message = $twilio->messages
                ->create($to, [
                    "from" => $twilioPhoneNumber, // Specify the Twilio phone number here
                    "body" => $messageBody,
                    // Add any additional parameters as needed
                ]);

            // Log the SID of the message for reference
            Log::info("SMS SID: " . $message->sid);

            return response()->json([
                'success' => true,
                'message' => 'SMS sent successfully',
                'sid' => $message->sid,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


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