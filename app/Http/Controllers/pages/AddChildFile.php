<?php

namespace App\Http\Controllers\pages;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class AddChildFile extends Controller
{
  public function indexParent()
  {
    return view('content.pages.pages-add-parent-file');
  }
  public function checkSsn(Request $request)
  {
      $ssn = $request->input('ssn');
      $user = User::where('ssn', $ssn)->first();
  
      if ($user) {
          return response()->json([
              'success' => true,
              'parentName' => $user->name,
          ]);
      }
  
      return response()->json(['success' => false]);
  }
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
          'national_number' => 'nullable|string|size:12|unique:children,national_number',
          'birth_status' => 'required',
          'identity_num' => 'nullable|string',
          'last_vaccination' => 'nullable|string',
          'next_vaccination' => 'required|string',
          'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
          'ssn' => 'required|string|size:5',
      ], [
          'name_child.required' => 'يجب إدخال اسم الطفل',
          'date_birth.required' => 'يجب إدخال مواليد الطفل',
          'birth_status.required' => 'يجب تحديد حالة الطفل',
          'national_number.required' => 'يجب إدخال الرقم الوطني',
          'ssn.required' => 'يجب اقتران ولي الأمر مع البيانات',
          'ssn.numeric' => 'يجب إدخال رقم القيد بالأرقام فقط',
          'identity_num.numeric' => 'يجب إدخال رقم الهوية بالأرقام فقط',
          'national_number.numeric' => 'يجب إدخال الرقم الوطني بالأرقام فقط',
          'national_number.size' => 'يجب أن يتكون الرقم الوطني من 12 رقماً',
          'next_vaccination.required' => 'يجب إدخال التطعيمة التالية',
      ]);
  
      // Find the user associated with the provided SSN
      $parent = User::where('ssn', $validatedData['ssn'])->first();
  
      if (!$parent) {
          // Handle case where parent with the provided SSN is not found
          return redirect()->back()->withErrors(['ssn' => 'الرقم الوطني لولي الأمر غير موجود']);
      }
  
      // Store the child's image if provided
      if ($request->hasFile('image_path')) {
        $imagePath = $request->file('image_path')->storeAs('public/child_images', $request->file('image_path')->getClientOriginalName());
        $validatedData['image_path'] = $imagePath;
    }
    
  
      // Assign the authenticated user's ID as the health center ID
      $validatedData['health_id'] = auth()->user()->id;
  
      // Assign the parent's ID to the child's parent_id field
      $validatedData['parent_id'] = $parent->id;
  
      // Log the validated data before storing it
      Log::info('Validated data:', $validatedData);
  
      // Create the child record
      Child::create($validatedData);
  
      // Redirect after creating the child
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
