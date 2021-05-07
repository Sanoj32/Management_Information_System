<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        //get the subjects the authenticated teacher is allowed to teach
        $teacher = auth()->user();
        // $teacher_code = $teacher->teacher_code;
        // $subjects = DB::table('bct_authorized_subjects')->where('teacher_code', $teacher_code)->get();
        // foreach ($subjects as $sub) {
        //     echo $sub->batch;
        // }
        return view('teacher.home', compact('teacher'));
    }
}
