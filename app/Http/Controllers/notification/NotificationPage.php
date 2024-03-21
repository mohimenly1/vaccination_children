<?php

namespace App\Http\Controllers\notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VaccinationInfoNotification;
use App\Notifications\VaccinationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;
class NotificationPage extends Controller
{
  public function index()
  {
    return view('content.pages.pages-show-notification-form');
  }


  public function sendNotification(Request $request)
  {
   // Replace these values with your Twilio credentials
    $sid = "AC1e81dcdb9e1fdd9b8ca7fbb3e43c9f01";
    $token = "81b93458a932f9825abcb10d8c4bdd95";
    $twilioPhoneNumber = "+15642148510"; // Your Twilio phone number

    $twilio = new Client($sid, $token);
    $to = "+218943187604";
    // Get request parameters
    // $to = $request->input('to');
    $vaccinationName = $request->input('vaccination_name');
    $workDay = $request->input('work_day_vaccination');

    // Construct the message body
    $messageBody = "تذكير: سيكون هناك تطعيمة  $vaccinationName في اليوم $workDay.";

    try {
        // Send SMS using Twilio
        $message = $twilio->messages
            ->create($to, [
                "from" => $twilioPhoneNumber, // Specify the Twilio phone number here
                "body" => $messageBody,
                // Add any additional parameters as needed
            ]);

        // Log the SID of the message for reference
        Log::info("SMS SID: " . $message->sid);

        // Send notification
        $notification = new VaccinationInfoNotification($vaccinationName, $workDay);
        $users = User::all();
        Notification::send($users, $notification);

        return redirect()->route('dashboard-analytics');
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send SMS',
            'error' => $e->getMessage(),
        ], 500);
    }
        
          // Save the notification to the database
    
          // Redirect to the previous page
          return redirect()->route('dashboard-analytics');
      }
  
  


  public function markAsRead($notificationId)
  {
      $user = auth()->user();
  
      $notification = $user->notifications()->where('id', $notificationId)->firstOrFail();
      $notification->markAsRead();
  
      return redirect()->back();
  }


}