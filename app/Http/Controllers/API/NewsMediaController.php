<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsMediaResource;
use App\Models\NewsMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NewsMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {     
       
        $news = NewsMedia::all();
        return NewsMediaResource::collection($news);
        
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
            $validatedData['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news = NewsMedia::create($validatedData);

        return response()->json([
            'message' => 'NewsMedia created successfully',
            'data' => new NewsMediaResource($news),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsMedia $news)
    {
        return new NewsMediaResource($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsMedia $news)
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
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validatedData['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($validatedData);

        return response()->json([
            'message' => 'NewsMedia updated successfully',
            'data' => new NewsMediaResource($news),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsMedia $news)
    {
       

        // Delete blog image from storage
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return response()->json(['message' => 'NewsMedia deleted successfully']);
    }
}
