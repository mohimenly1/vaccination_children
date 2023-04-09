<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AmountVaccination;
use App\Models\Child;
use App\Models\VaccinationChildAdd;
use App\Models\VaccinationNames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationAddChild extends Controller
{
  public function index()
  {
      $health_id = Auth::user()->id;

      $vaccination_namess = AmountVaccination::select('amount_vaccination.*', 'vaccination_names.vaccination_name', 'amount_vaccination.vaccination_name as vaccination_name_id')
      ->where('health_id', $health_id)
      ->join('vaccination_names', 'amount_vaccination.vaccination_name', '=', 'vaccination_names.id')
      ->get();

    
 
      return view('content.pages.pages-add-vaccination-child', compact('vaccination_namess'));
  }
  


  public function getChildName($national_number)
{
    $child = Child::where('national_number', $national_number)->first();

    if ($child) {
        $child_name = $child->name_child;
        return response()->json(['name' => $child_name]);
    } else {
        return response()->json(['error' => 'Child not found']);
    }
}
public function getChildNatinonalNumber($id)
{
    $child = Child::find($id);

    if ($child) {
        $national_number = $child->national_number;
        return response()->json(['national_number' => $national_number]);
    } else {
        return response()->json(['error' => 'Child not found']);
    }
}



public function store(Request $request)
{
    $validatedData = $request->validate([
        'NidChild' => 'required|exists:children,national_number',
        'VaccinationName' => 'required',
        'VaccinationDate' => 'required|date',
        'NurseName' => 'required|string|max:255',
        'HealthCenterId' => 'required'
    ],
    [
        'NidChild.required' => 'يرجى إدخال الرقم الوطني للطفل',
        'NidChild.exists' => 'الرقم الوطني الذي تم إدخاله غير صحيح',
        'VaccinationName.required' => 'يرجى إدخال اسم التطعيمة',

        'VaccinationDate.required' => 'يرجى إدخال تاريخ التطعيم',
        'VaccinationDate.date' => 'تاريخ التطعيم غير صحيح',
        'NurseName.required' => 'يرجى إدخال اسم الممرضة',
        'NurseName.max' => 'يجب ألا يتجاوز اسم الممرضة 255 حرفًا',
    ]);

    $national_number = $request->input('NidChild');
    $health_id = Auth::user()->id;
    $child = Child::where('national_number', $national_number)->firstOrFail();
    $vaccination_name = $request->input('VaccinationName');
    $amount_vaccination = AmountVaccination::where('health_id', $health_id)
        ->where('vaccination_name', $vaccination_name)
        ->first();
    
    // Check if the vaccination exists

    if ($amount_vaccination) {
        $vaccination = new VaccinationChildAdd();
        $vaccination->NidChild = $child->id;
        $vaccination->VaccinationName = $amount_vaccination->id;
        $vaccination->VaccinationDate = $validatedData['VaccinationDate'];
        $vaccination->NurseName = $validatedData['NurseName'];
        $vaccination->HealthCenterId = $health_id;
        $vaccination->save();
    
        // update the vaccination count for the selected vaccination name
        $amount_vaccination->vaccination_count -= 1;
        $amount_vaccination->save();
    } else {
        // If the vaccination does not exist, return an error message
        return redirect()->back()->withErrors(['VaccinationName' => 'التطعيمة غير موجودة']);
    }

    // if ($amountVaccination->vaccination_count < 1) {
    //     return redirect()->back()->withErrors(['VaccinationName' => 'الكمية انتهت']);
    // }
 
    return redirect()->route('dashboard-analytics');
}



  
  

}
