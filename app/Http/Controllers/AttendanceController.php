<?php

namespace App\Http\Controllers;

use App\Models\BctAttendance;
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
        // get the current day of the attendance
        $previousAttendances = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->get();
        if ($previousAttendances->isNotEmpty()) {
            $prev = $previousAttendances->sortByDesc('created_at')->first();
            $day = $prev->day + 1;
            $date = $prev->created_at;
        } else {
            $day = 1;
        }
        $students = BctStudent::where('batch', $batch)->get();
        return view('teacher.attendance_dashboard', compact('subject', 'batch', 'day', 'students', 'previousAttendances'));
    }
    public function showAttendanceView($batch, BctSubject $subject)
    {
        $previousAttendances = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->get();
        if ($previousAttendances->isNotEmpty()) {
            $prev = $previousAttendances->sortByDesc('created_at')->first();
            $day = $prev->day + 1;
        } else {
            $day = 1;
        }
        $students = BctStudent::where('batch', $batch)->get();

        return view('teacher.attendance', compact('subject', 'batch', 'students', 'day'));
    }
    // This method is responsibe for adding attendance data to the database
    public function recordAttendance($batch, BctSubject $subject, $day)
    {
        $students = BctStudent::where('batch', $batch)->get();
        $presentStudents = request()->attendance;
        foreach ($students as $student) {
            $bctAttendance = new BctAttendance();
            $bctAttendance->roll_number = $student->roll_number;
            $bctAttendance->teacher_code = auth()->user()->teacher_code;
            $bctAttendance->batch = $batch;
            $bctAttendance->subject_code = $subject->subject_code;
            $bctAttendance->day = $day;
            if (in_array($student->roll_number, $presentStudents)) {
                $bctAttendance->attendance = "P";
            } else {
                $bctAttendance->attendance = "A";
            }
            $bctAttendance->save();
        }
        return redirect('/teachers/attendancedashboard/' . $batch . '/' . $subject->subject_code);
    }
    public function editAttendance(){
        
    }
}
