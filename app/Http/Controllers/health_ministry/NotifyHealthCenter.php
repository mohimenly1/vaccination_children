<?php

namespace App\Http\Controllers\health_ministry;

use App\Http\Controllers\Controller;
use App\Models\AmountVaccination;
use App\Models\User;
use App\Models\VaccinationChildAdd;
use App\Models\VaccinationNames;
use App\Notifications\AdsVaccination;
use App\Notifications\InfoVaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotifyHealthCenter extends Controller{

  

    public function index()
    {
        $health_centers = User::where('role', 'users_health_center')->get();
        $vaccinations = AmountVaccination::all();
        $vaccinationName = VaccinationNames::all();
    
        return view('content.pages.health-ministry.notify-health-center', compact('health_centers','vaccinations','vaccinationName'));
    }

    public function indexInfo(){
        return view('content.pages.health-ministry.notify-info-vaccination');
    }

    public function sendNotification(Request $request)
    {
        // Get the selected health center and vaccination from the request
        $healthCenterId = $request->input('health_center');
        $vaccinationName = $request->input('available_vaccination');
        $vaccinationCount = $request->input('vaccination_count');
    
        // Get the existing amount vaccination record for the selected health center and vaccination
        $amountVaccination = AmountVaccination::where('health_id', $healthCenterId)
            ->where('vaccination_name', $vaccinationName)
            ->first();
 
        // If a record exists, update the vaccination count, otherwise create a new record
        if ($amountVaccination) {
            $amountVaccination->vaccination_count += $vaccinationCount;
            $amountVaccination->save();
        } else {
            $amountVaccination = AmountVaccination::create([
                'vaccination_name' => $vaccinationName,
                'vaccination_count' => $vaccinationCount,
                'health_id' => $healthCenterId,
            ]);
        }

        $mohimen = $amountVaccination->vaccination_name()->first();

        
        // Send notification to each health center user
        $notification = new AdsVaccination($mohimen->vaccination_name, $amountVaccination->healthCenter->name, $vaccinationCount);
        $healthCenterUsers = User::where('role', 'users_health_center')->get();
    
        foreach ($healthCenterUsers as $user) {
            $user->notify($notification);
        }
    
        // Redirect back with a success message
        return redirect()->route('dashboard-analytics')->with('success', 'تم تحديث عدد التطعيمات بنجاح.');
    }
    
  
    

public function addVac(Request $request){

    $VaccinationName = $request->input('VaccinationName');

   $amount_va = new VaccinationNames();

   $amount_va->vaccination_name = $VaccinationName;

   $amount_va->save(); 


    return redirect()->route('notify-health-center');

}

public function sendInfoVaccinationNotification(Request $request)
{
    // Get the values from the form
    $vaccination_name_info = $request->input('vaccination_name_info');
    $benefit_vaccination_info = $request->input('benefit_vaccination_info');
    $complications_vaccination_info = $request->input('complications_vaccination_info');

    // Create the notification instance
    $notification = new InfoVaccination($vaccination_name_info, $benefit_vaccination_info, $complications_vaccination_info);

    // Send the notification to all users
    $users = User::all();
    Notification::send($users, $notification);

    // Redirect back with success message
    return redirect()->route('dashboard-analytics');
}
    
}
