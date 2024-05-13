<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mentee;
use App\Models\Mentor;

class MappingController extends Controller
{
    public function map()
    {
        $mentees = Mentee::all();
        $mentors = Mentor::all();
        
        return view('mapping', compact('mentees', 'mentors'));
    }
    
    public function mappingstore(Request $request)
    {
        $menteeId = $request->input('mentee_id');
        $mentorId = $request->input('mentor_id');
        
        // Check if the mentor is already mapped to another mentee
        $existingMapping = DB::table('mentor_mentee_map')
            ->where('mentor_id', $mentorId)
            ->first();
        
        if ($existingMapping) {
            return redirect()->back()->with('error', 'The selected mentor is already mapped to another mentee!');
        }
        
        // Check if the mentee is already mapped to another mentor
        $existingMapping = DB::table('mentor_mentee_map')
            ->where('mentee_id', $menteeId)
            ->first();
        
        if ($existingMapping) {
            return redirect()->back()->with('error', 'The selected mentee is already mapped to another mentor!');
        }
        
        // If not, store the mapping in the database
        DB::table('mentor_mentee_map')->insert([
            'mentor_id' => $mentorId,
            'mentee_id' => $menteeId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Mapping saved successfully!');
    }

    public function showMapping()
{
    $mappingData = DB::table('mentor_mentee_map')->get();
    return view('mapping', compact('mappingData'));
}
}
