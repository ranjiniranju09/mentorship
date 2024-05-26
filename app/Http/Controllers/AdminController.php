<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function admin()
    {

        $sessions = DB::table('sessions')->get();

        $mappingData = DB::table('mentor_mentee_map')
        ->join('mentors', 'mentor_mentee_map.mentor_id', '=', 'mentors.id')
        ->join('mentees', 'mentor_mentee_map.mentee_id', '=', 'mentees.id')
        ->select('mentors.name as mentor_name', 'mentees.name as mentee_name')
        ->get();


        return view('admin', compact('sessions','mappingData'));
    
    }
    public function adminstore(Request $request)
    {
        DB::table('logins')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'username' => $request->input('username'),
            'role' => 'admin', // Set default value to "ADMIN"
            'password' => bcrypt($request->input('password')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view("login");

    }

}
