<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\AmountVaccination;
use App\Models\Child;
use App\Models\VaccinationChildAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
      $report = VaccinationChildAdd::select(
        'health_center_users.id as health_id',
          DB::raw('COUNT(DISTINCT vaccinations.id) as vaccinations_count'),
          DB::raw('COUNT(DISTINCT children.id) as children_count'),
          'health_center_users.name as health_center_name',
          'added_by_users.name as added_by_user_name'
      )
      ->join('users as added_by_users', 'added_by_users.id', '=', 'vaccinations.HealthCenterId')
      ->join('users as health_center_users', 'health_center_users.id', '=', 'vaccinations.HealthCenterId')
      ->leftJoin('children', 'children.health_id', '=', 'health_center_users.id')
      ->where('added_by_users.role', '=', 'users_health_center')
      ->groupBy('health_center_users.id', 'added_by_users.id', 'health_center_name', 'added_by_user_name')
      ->get();
  
      $vaccinationReport = AmountVaccination::select('amount_vaccination.health_id', 'vaccination_names.vaccination_name', 'amount_vaccination.vaccination_count')
      ->join('users', 'users.id', '=', 'amount_vaccination.health_id')
      ->join('vaccination_names', 'vaccination_names.id', '=', 'amount_vaccination.vaccination_name')
      ->where('users.role', '=', 'users_health_center')
      ->get();
  

  
  
      $children = Child::count();
  
      return view('content.dashboard.dashboards-analytics', compact('report', 'vaccinationReport', 'children'));
  }
  
}
