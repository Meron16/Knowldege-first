<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\InternationalRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternationalRegistrationController extends Controller
{
    //


public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:international_registrations',
        'country_code' => 'required',
        'phone' => 'required',
        'course_level' => 'required',
        'student_type' => 'required',
        'registration_type' => 'required',
      
    ]);
     
   
    if ($request->hasFile('file_upload')) {
        $validated['file_upload'] = $request->file('file_upload')->store('volunteer_files', 'public');
    }

    InternationalRegistration::create($validated);

    return response()->json(['message' => 'Application submitted successfully.'], 201);
}

}
