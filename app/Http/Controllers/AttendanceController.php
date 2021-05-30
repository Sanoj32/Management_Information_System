<?php

namespace App\Http\Controllers;

use App\Models\BctAttendance;
use App\Models\BctAttendanceReport;
use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Krishnahimself\DateConverter\DateConverter;


class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'suspended']);
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
        // dd($attendanceStatus);
        // Checks if the attendance has been closed and if a report has been made.
        $checkForReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForReport->isNotEmpty()) {
            return redirect('/teachers/closed/attendancedashboard/' . $batch . '/' . $subject->subject_code);
        }
        $dateNow = Carbon::now('Asia/Kathmandu');
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
        return view('teacher.attendance_dashboard', compact('subject', 'batch', 'day', 'students', 'previousAttendances', 'dateNow'))->with('attendanceSuccess', session('attendanceSuccess'));
    }
    public function showAttendanceView($batch, BctSubject $subject, $day)
    {
        $checkForReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForReport->isNotEmpty()) {
            return redirect('/teachers/closed/attendancedashboard/' . $batch . '/' . $subject->subject_code);
        }
        $dateNow = Carbon::now('Asia/Kathmandu');
        $nameOfDay = getNameOfDay($dateNow->dayOfWeek);
        $nepaliDate = DateConverter::fromEnglishDate($dateNow->year, $dateNow->month, $dateNow->day)->toNepaliDate();
        $previousAttendances = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->get();
        $students = BctStudent::where('batch', $batch)->get();

        return view('teacher.attendance', compact('subject', 'batch', 'students', 'day', 'nepaliDate', 'nameOfDay'));
    }
    // This method is responsibe for adding attendance data to the database
    public function recordAttendance($batch, BctSubject $subject, $day)
    {
        $checkForReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForReport->isNotEmpty()) {
            return redirect('/teachers/closed/attendancedashboard/' . $batch . '/' . $subject->subject_code);
        }
        if (empty(request()->attendance)) {
            return back()->with('attendanceFailed', 'Attendance can not be empty! Atleast one student must be present.');
        }
        // Check for submitting duplicate attendance causing attendance of same batch, subject and day to be stored twice.
        $testAttendance = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->where('day', $day)
            ->first();
        if (!empty($testAttendance)) {
            return redirect('/')->with('duplicateAttendance', 'The attendance for this day has already been taken');
        }

        $students = BctStudent::where('batch', $batch)->get();
        $presentStudents = request()->attendance;
        foreach ($students as $student) {
            $bctAttendance = new BctAttendance();
            $bctAttendance->roll_number = $student->roll_number;
            $bctAttendance->teacher_code = auth()->user()->teacher_code;
            $bctAttendance->batch = $batch;
            $bctAttendance->subject_code =  $subject->subject_code;
            $bctAttendance->day = $day;
            if (in_array($student->roll_number, $presentStudents)) {
                $bctAttendance->attendance = "P";
            } else {
                $bctAttendance->attendance = "A";
            }
            $bctAttendance->save();
        }
        return redirect('/teachers/attendancedashboard/' . $batch . '/' . $subject->subject_code)->with('attendanceSuccess', 'Attendance Recorded Succesfully.');
    }
    // variable lastDay meaning the day of latest attendance taken
    public function showUpdateView($batch, BctSubject $subject, $lastDay)
    {
        $checkForReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForReport->isNotEmpty()) {
            return redirect('/teachers/closed/attendancedashboard/' . $batch . '/' . $subject->subject_code);
        }
        $students = BctStudent::where('batch', $batch)->get();
        $previousAttendance = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->where('day', $lastDay)
            ->get();
        $prev = $previousAttendance->first();
        $date = $prev->created_at;
        $day = $prev->day;
        $nepaliDate = DateConverter::fromEnglishDate($date->year, $date->month, $date->day)->toNepaliDate();


        return view('teacher.edit_attendance', compact('subject', 'batch', 'students', 'previousAttendance', 'lastDay', 'nepaliDate', 'day'));
    }
    public function updateAttendance($batch, BctSubject $subject, $lastDay, Request $request)
    {
        $checkForReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForReport->isNotEmpty()) {
            return redirect('/teachers/closed/attendancedashboard/' . $batch . '/' . $subject->subject_code);
        }
        $updatedPresentStudents = $request->attendance;
        if (empty($updatedPresentStudents)) {
            return back()->with('attendanceUpdateFailed', "Atleast one student must be present.");
        }
        $previousAttendance = BctAttendance::where('subject_code', $subject->subject_code)
            ->where('batch', $batch)
            ->where('day', $lastDay)
            ->get();
        foreach ($previousAttendance as $prev) {
            if (in_array($prev->roll_number, $updatedPresentStudents)) {
                $prev->attendance = "P";
            } else {
                $prev->attendance = "A";
            }
            $prev->save();
        }
        return redirect('/teachers/attendancedashboard/' . $batch . '/' . $subject->subject_code)->with('attendanceUpdateSuccess', "Attendance Updated Successfully.");
    }
    public function showClosedAttendanceView($batch, BctSubject $subject)
    {
        $reportData = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        $students = BctStudent::where('batch', $batch)->get();
        foreach ($students as $student) {
            $individualReportData = $reportData->where('roll_number', $student->roll_number)->first();
            $student->presentDays = $individualReportData->present_days;
            $student->totalDays = $individualReportData->total_days;
            $student->presentPercent = round(($individualReportData->present_days / $individualReportData->total_days) * 100, 2);
        }
        return view('teacher.closed_attendance_dashboard', compact('batch', 'subject', 'students', 'reportData'));
    }
}
