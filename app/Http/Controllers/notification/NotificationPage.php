<?php

namespace App\Http\Controllers\notification;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VaccinationInfoNotification;
use App\Notifications\VaccinationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationPage extends Controller
{
  public function index()
  {
    return view('content.pages.pages-show-notification-form');
  }


  public function sendNotification(Request $request)
  {
      if ($request->isMethod('post')) {
          $request->validate([
              'vaccination_name' => 'required|string',
              'work_day_vaccination' => 'required|date',
          ],[
              'vaccination_name.required' =>'إسم التطعيمة مطلوب',
              'work_day_vaccination.required' => 'ايام العمل مطلوبة'
          ]);
    
          $vaccinationName = $request->input('vaccination_name');
          $workDay = $request->input('work_day_vaccination');
        
          $notification = new VaccinationInfoNotification($vaccinationName, $workDay);
          $users = User::all();
        
          Notification::send($users, $notification);
        
          // Save the notification to the database
    
          // Redirect to the previous page
          return redirect()->route('dashboard-analytics');
      }
  }
  


  public function markAsRead($notificationId)
  {
      $user = auth()->user();
  
      $notification = $user->notifications()->where('id', $notificationId)->firstOrFail();
      $notification->markAsRead();
  
      return redirect()->back();
  }


}