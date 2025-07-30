<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
       
        $events = Event::all();
        return EventResource::collection($events);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'headline' => 'required|string|max:255',
            'description' => 'required|string',
            'details' => 'required|string',
            'video_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('event_images', 'public');
        }

        $events = Event::create($validatedData);

        return response()->json([
            'message' => 'Event created successfully',
            'data' => new EventResource($events),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $events)
    {
        return new EventResource($events);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $events)
    {
        

        $validatedData = $request->validate([
            'headline' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'details' => 'sometimes|required|string',
            'video_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($events->image) {
                Storage::disk('public')->delete($events->image);
            }
            $validatedData['image'] = $request->file('image')->store('event_images', 'public');
        }

        $events->update($validatedData);

        return response()->json([
            'message' => 'Event updated successfully',
            'data' => new EventResource($events),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $events)
    {
       

        // Delete blog image from storage
        if ($events->image) {
            Storage::disk('public')->delete($events->image);
        }

        $events->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
