<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BctAttendance;
use App\Models\BctAttendanceReport;
use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;

class StudentAnalysisController extends Controller
{
    public function index()
    {
        return view('admin.analysis.index');
    }

    /**
     * show the attendance analysis of a single student.
     */
    public function show(Request $request)
    {
        $rollNumber = "LEC" . "0" . $request['batch'] . "BCT" . "0" . $request['roll'];
        $student = BctStudent::where('roll_number', $rollNumber)
            ->first();
        $reports = BctAttendanceReport::where('roll_number', $rollNumber)->get();
        foreach ($reports as $report) {
            $subject = BctSubject::where('subject_code', $report->subject_code)->first();
            $report->semester = $subject->semester;
            $report->subject_name = $subject->name;
        }
        $activeAttendaces = BctAttendance::where('roll_number', $rollNumber)->get();
        $subjects = $activeAttendaces::select('subject_code')->distict();
        dd($subjects);
        $semesters = [1, 2, 3, 4, 5, 6, 7, 8];

        return view("admin.analysis.show", compact('reports', 'semesters'));
    }
}
