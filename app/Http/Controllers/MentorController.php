<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function mentor()
    {
        return view('mentor');
    }

    public function dashboardmentor()
    {
        return view('dashboardmentor');
    }
    public function mentorsessionadd()
    {
        return view('mentorsessionadd');
    }
    public function mentortaskadd()
    {
        return view('mentortaskadd');
    }

    public function mentorprofile()
    {
        return view('mentorprofile');
    }
    public function mentorresourceadd()
    {
        return view('mentorresourceadd');
    } 

}
