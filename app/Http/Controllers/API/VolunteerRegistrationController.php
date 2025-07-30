<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VolunteerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VolunteerRegistrationController extends Controller
{
    //
    public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:volunteer_registrations',
        'phone' => 'required',
        'country_code' => 'required',
        'position' => 'required',
        'volunteer_location' => 'required',
        'start_date' => 'required|date',
        'cv_link' => 'nullable|url',
        'file_upload' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    if ($request->hasFile('file_upload')) {
        $validated['file_upload'] = $request->file('file_upload')->store('volunteer_files', 'public');
    }

    VolunteerRegistration::create($validated);

    return response()->json(['message' => 'Application submitted successfully.'], 201);
}
}
