<?php

namespace App\Http\Controllers;

use App\Models\BctAttendance;
use App\Models\BctStudent;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function takeAttendance(Request $request)
    {
        $students = BctStudent::all();
        foreach($students as $student){
            if(in_array($student->roll_number, $request->attendance)){
                $present = 1;
            }
            BctStudent::create([
                'subject_code' => ''
            ])
        }
    }
}
