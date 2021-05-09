<?php

namespace App\Http\Controllers;

use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;

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
        // $authorizedSubjects = DB::table('bct_authorized_subjects')->where('teacher_code', $teacher->teacher_code)->get();
        return view('teacher.home', compact('teacher'));
    }
    public function index($batch, BctSubject $subject)
    {
        return view('teacher.attendance_dashboard', compact('subject', 'batch'));
    }
    public function takeAttendance($batch, $subject)
    {
        $students = BctStudent::where('roll_number');
        return view('teacher.attendance', compact('subject', 'batch'));
    }
}
