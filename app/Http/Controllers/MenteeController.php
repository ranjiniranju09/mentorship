<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\MentorMenteeMap;

class MenteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function menteedash()
    {

        return view('mentees');
    }

    public function showAssignedMentor(Request $request)
    {
        // Get the logged-in mentee's ID
        $menteeId = $request->user()->id;

        // Find the mentor assigned to the mentee
        $mentorMap = MentorMenteeMap::where('mentee_id', $menteeId)->first();

        if ($mentorMap) {
            // Mentor found, now get mentor details
            $mentor = mentor::find($mentorMap->mentor_id);

            return view('assigned_mentor', ['mentor' => $mentor]);
        } else {
            // No mentor assigned
            return view('no_assigned_mentor');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
