<?php

namespace App\Http\Controllers\health_ministry;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OperationsHealthMinistry extends Controller{

    public function index() {
        $users = User::where('role', 'users_health_center')->get();
     
        return view('content.pages.health-ministry.operations-health-ministry', compact('users'));
    }


    public function updateActivation($id){
        $user = User::find($id);
        $user->update(request()->validate(['active' => 'required|boolean']));
    }


    public function edit($id)
    {
        $user = User::find($id);
      return view('content.pages.health-ministry.edit-health-center', compact('user'));
    }


    public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email',
      'username' => 'required|string|unique:users,username,'.$id,
    ], [
      'name.required' => 'يجب إدخال اسم المركز الصحي',
      'email.required' => 'يجب إدخال البريد الإلكتروني',
      'username.required' => 'يجب إدخال إسم مستخدم',
      'username.unique' => 'هذا المستخدم موجود بالفعل',
      'email.email' => 'يجب إدخال بريد إلكتروني حقيقي',
    ]);

    $user = User::find($id);
    $user->update($validatedData);

    // your code after updating the user

    return redirect()->route('dashboard-analytics');
  }


  public function showMap(){
    $initialMarkers = [
      [
          'position' => [
              'lat' => 28.625485,
              'lng' => 79.821091
          ],
          'draggable' => true
      ],
      [
          'position' => [
              'lat' => 28.625293,
              'lng' => 79.817926
          ],
          'draggable' => false
      ],
      [
          'position' => [
              'lat' => 32.625182,
              'lng' => 79.81464
          ],
          'draggable' => true
      ]
  ];
    return view('content.pages.health-ministry.show-map',compact('initialMarkers'));
  }


  public function submitLocation(Request $request, $id)
  {

    $user = User::find($id);
      $user->latitude = $request->input('lat');
      $user->longitude = $request->input('lng');
      $user->save();
  
      return redirect()->route('health-ministry-operations');
  }
  

public function showMapUser($id)
    {
      
        $user = User::find($id);

        $initialMarkers = [
          [
              'position' => [
                  'lat' => $user->latitude,
                  'lng' => $user->longitude
              ],
              'draggable' => true
          ]
      ];
    
      return view('content.pages.health-ministry.show-map', compact('user', 'initialMarkers'));
    
    }
  

}