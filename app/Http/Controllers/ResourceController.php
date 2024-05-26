<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Facades\Storage; // Import Storage facade for file handling

class ResourceController extends Controller
{
    public function show($mentorId)
    {

    

        return view('resources',compact('mentorId'));
    }

    public function store(Request $request,$mentorId)
    {
        // return $mentorId;
        // Assume mentor_id is passed in the request without validation
        // $mentorId = $request->mentor_id;


        // Verify if the mentor exists
        $mentor = DB::table('mentors')->where('id', $mentorId)->first();


        if (!$mentor) {
            return redirect()->back()->with('error', 'You are not authorized to add resources.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resources');
        }
        

        DB::table('resources')->insert([
            'mentorId' => $mentorId,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'link' => $request->link,
            'visibility' => $request->visibility,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Notify admin (implementation depends on your notification system)
        // e.g., Notification::send($admin, new ResourceSubmitted($resource));

        return redirect()->back()->with('success', 'Resource submitted for approval.');
    }

    public function index()
    {
        $resources = DB::table('resources')->where('is_approved', true)->get();
        return view('resources', ['resources' => $resources]);
    }

    public function approve($resourceId)
    {
        DB::table('resources')
            ->where('id', $resourceId)
            ->update(['is_approved' => true, 'updated_at' => now()]);

        return redirect()->route('pending')->with('success', 'Resource approved.');
    }

    public function pending()
    {
        $resources = DB::table('resources')->where('is_approved', false)->get();
        return view('viewresources', ['resources' => $resources]);
    }

    public function viewMenteeResources($menteeId)
    {
        // Find the mapping record for the mentee
        $mapping = DB::table('mentor_mentee_map')->where('mentee_id', $menteeId)->first();
    
        if (!$mapping) {
            // Handle case where mapping is not found
            return redirect()->back()->with('error', 'No mentor mapped to this mentee.');
        }
    
        // Get the mentor ID from the mapping
        $mentorId = $mapping->mentor_id;
    
        // Fetch all relevant resources (mentor's and public)
        $resources = DB::table('resources')
            ->where(function($query) use ($mentorId) {
                $query->where('mentorId', $mentorId)
                      ->orWhere('visibility', 'public');
            })
            ->where('is_approved', true)
            ->get();
    
        // Separate resources based on visibility
        $mentorResources = $resources->filter(function($resource) use ($mentorId) {
            return $resource->mentorId == $mentorId;
        });
    
        $publicResources = $resources->filter(function($resource) {
            return $resource->visibility == 'public';
        });
    
        // Pass categorized resources to the view
        return view('menteeresources', [
            'mentorResources' => $mentorResources,
            'publicResources' => $publicResources
        ]);
    }
    
    

    public function menteeResources($mentee_id)
{
    // Find the mentee by ID
    $mentee = DB::table('mentees')->where('id', $mentee_id)->first();

    if (!$mentee) {
        // Handle case where mentee is not found
        return redirect()->back()->with('error', 'Mentee not found');
    }

    // Get the mentor of the mentee
    $mentorId = $mentee->mentor_id;

    // Fetch resources added by the mentee's mentor and public resources
    $resources = DB::table('resources')
        ->where(function($query) use ($mentorId) {
            $query->where('mentorId', $mentorId)
                  ->orWhere('visibility', 'public');
        })
        ->where('is_approved', true)
        ->get();

    // Pass all resources to the view
    return view('menteeresources', [
        'allResources' => $resources
    ]);
}

}

