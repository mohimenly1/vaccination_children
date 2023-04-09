<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class AddChildFile extends Controller
{
  public function index()
  {
    return view('content.pages.pages-add-child-file');
  }


  public function edit($id)
  {
    $child = Child::find($id);
    return view('content.pages.edit-child.edit-child', compact('child'));
  }


  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'name_child' => 'required|string|max:255',
      'date_birth' => 'required|date',
      'national_number' => 'required|string|size:12|unique:children,national_number,'.$id,
      'birth_status' => 'required',
      'last_vaccination' => 'nullable|string',
      'next_vaccination' => 'required|string',
    ], [
      'name_child.required' => 'يجب إدخال اسم الطفل',
      'date_birth.required' => 'يجب إدخال مواليد الطفل',
      'birth_status.required' => 'يجب تحديد حالة الطفل',
      'national_number.required' => 'يجب إدخال الرقم الوطني',
      'national_number.numeric' => 'يجب إدخال الرقم الوطني بالأرقام فقط',
      'national_number.size' => 'يجب أن يتكون الرقم الوطني من 12 رقماً',
      'national_number.unique' => 'هذا الرقم الوطني مستخدم بالفعل',
      'next_vaccination.required' => 'يجب إدخال التطعيمة التالية',
    ]);

    $child = Child::find($id);
    $child->update($validatedData);

    // your code after updating the child

    return redirect()->route('dashboard-analytics');
  }

  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'name_child' => 'required|string|max:255',
          'date_birth' => 'required|date',
          'national_number' => 'required|string|size:12|unique:children,national_number',
          'birth_status' => 'required',
          'last_vaccination' => 'nullable|string',
          'next_vaccination' => 'required|string',
      ], [
          'name_child.required' => 'يجب إدخال اسم الطفل',
          'date_birth.required' => 'يجب إدخال مواليد الطفل',
          'birth_status.required' => 'يجب تحديد حالة الطفل',
          'national_number.required' => 'يجب إدخال الرقم الوطني',
          'national_number.numeric' => 'يجب إدخال الرقم الوطني بالأرقام فقط',
          'national_number.size' => 'يجب أن يتكون الرقم الوطني من 12 رقماً',
          'national_number.unique' => 'هذا الرقم الوطني مستخدم بالفعل',
          'next_vaccination.required' => 'يجب إدخال التطعيمة التالية',
      ]);
  
      $validatedData['health_id'] = auth()->user()->id;
  
      Child::create($validatedData);
  
      // your code after creating the child
  
      return redirect()->route('dashboard-analytics');
  }
  

  public function deleteChild(Request $request, $id)
{
    $child = Child::find($id);
    if (!$child) {
        abort(404);
    }

    // Delete the child record from the database
    $child->delete();

    // Redirect to the children index page with a success message
 
}
  
}
