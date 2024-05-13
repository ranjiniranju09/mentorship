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
}
