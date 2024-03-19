<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AmountVaccination;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationsChild extends Controller
{
  public function index()
  {
      $user = Auth::user();
      $health_id = $user->id;
      $children = Child::where('health_id', $health_id)->paginate(5);

    

      $vaccination_namess = AmountVaccination::select('amount_vaccination.*', 'vaccination_names.vaccination_name', 'amount_vaccination.vaccination_name as vaccination_name_id')
      ->where('health_id', $health_id)
      ->join('vaccination_names', 'amount_vaccination.vaccination_name', '=', 'vaccination_names.id')
      ->get();
      return view('content.pages.pages-operations-child', compact('children','vaccination_namess'));
  }
  

  public function search(Request $request)
  {
      $query = $request->input('query');
      $health_id = auth()->user()->id;
      $children = Child::where('health_id', $health_id)
                       ->where(function($q) use ($query) {
                           $q->where('name_child', 'LIKE', "%$query%")
                             ->orWhere('national_number', 'LIKE', "%$query%");
                       })
                       ->paginate(5);
    $vaccination_namess = AmountVaccination::select('amount_vaccination.*', 'vaccination_names.vaccination_name', 'amount_vaccination.vaccination_name as vaccination_name_id')
    ->where('health_id', $health_id)
    ->join('vaccination_names', 'amount_vaccination.vaccination_name', '=', 'vaccination_names.id')
    ->get();
      return view('content.pages.pages-operations-child', compact('children','vaccination_namess'));
  }
  


  public function printHealthFile(Request $request, $id)
  {
      $child = Child::findOrFail($id);
      
      // Fetch vaccinations with their names using a join
      $vaccinations = DB::table('vaccinations')
          ->join('amount_vaccination', 'vaccinations.VaccinationName', '=', 'amount_vaccination.id')
          ->join('vaccination_names', 'amount_vaccination.vaccination_name', '=', 'vaccination_names.id')
          ->select('vaccinations.*', 'vaccination_names.vaccination_name as vaccination_name')
          ->where('vaccinations.NidChild', $id)
          ->get();
  
      return view('content.pages.pages-operations-child-print', compact('child', 'vaccinations'));
  }
  


  
  

  
}
