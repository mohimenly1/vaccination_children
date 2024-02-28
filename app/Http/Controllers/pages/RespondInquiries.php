<?php

namespace App\Http\Controllers\pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RespondInquiry;

class RespondInquiries extends Controller
{
    public function index()
    {
        $inquiries = RespondInquiry::paginate(5);
        return view('content.pages.respond-inquiries.respond-inquiries', compact('inquiries'));
    }


    
    
    
    

    public function update(Request $request, $id)
    {
        $inquiry = RespondInquiry::findOrFail($id);
        
        // Check if the user has the required role
        if ($request->user()->role !== 'users_health_center' && $request->user()->role !== 'users_health_ministry') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        // Validate the request data
        $validatedData = $request->validate([
            'FeedBackReply' => 'required|string'
        ]);
    
        // Update the inquiry with the response text and state
        $inquiry->FeedBackReply = $validatedData['FeedBackReply'];
        $inquiry->FeedBackState = 'تم الرد';
        $inquiry->save();
        $request->session()->flash('feedback_reply', $inquiry->FeedBackReply);
      
        // Store the inquiry id in the session
        $request->session()->flash('inquiry_id', $inquiry->id);
      
        return response()->json($inquiry);
    }
    
  

}