<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;
use App\Models\BctAttendance;
use App\Http\Controllers\Controller;
use App\Models\BctAttendanceReport;

class BctAttendanceReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the all active attendances.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeAttendances = BctAttendance::select('subject_code', 'batch')->distinct()->get();
        $activeAttendances = $activeAttendances->sortBy('batch');
        $uniqueBatches = [];
        foreach ($activeAttendances as $active) {
            if (!in_array($active->batch, $uniqueBatches)) {
                array_push($uniqueBatches, $active->batch);
            }
            $subject = BctSubject::select('name')->where('subject_code', $active->subject_code)->first();
            $active->name = $subject->name;
        }
        return view('admin.active_attendances', compact('activeAttendances', 'uniqueBatches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($batch, BctSubject $subject)
    {
        $previousReport = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($previousReport->isEmpty()) {
            $students = BctStudent::where('batch', $batch)->get();
            $attendances = BctAttendance::where('batch', $batch)
                ->where('subject_code', $subject->subject_code)
                ->get();
            foreach ($students as $student) {
                $attendances = BctAttendance::where('batch', $batch)
                    ->where('subject_code', $subject->subject_code)
                    ->where('roll_number', $student->roll_number)
                    ->get();
                $presentDays = 0;
                $totalDays = 0;
                foreach ($attendances as $attendance) {
                    $totalDays += 1;
                    if ($attendance->attendance == "P") {
                        $presentDays += 1;
                    }
                }
                $report = new BctAttendanceReport();
                $report->roll_number = $student->roll_number;
                $report->subject_code = $subject->subject_code;
                $report->present_days = $presentDays;
                $report->total_days = $totalDays;
                $report->batch = $batch;
                $report->save();
            }
            foreach ($attendances as $attendance) {
                $attendance->delete();
            }
        } else {
            return back()->with('duplicateReport', "This attendance has already been closed");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified attendance of a specified batch and subject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($batch, BctSubject $subject)
    {
        // check if this attendance has been closed already
        $checkForClosure = BctAttendanceReport::where('batch', $batch)
            ->where('subject_code', $subject->subject_code)
            ->get();
        if ($checkForClosure->isNotEmpty()) {
            return back()->with('attendanceClosed', "This attendance has been closed by the department");
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
        }else {
            $day = 1;
        }
        $students = BctStudent::where('batch', $batch)->get();
        return view('admin.active_attendance_dashboard', compact('subject', 'batch', 'day', 'students', 'previousAttendances', 'dateNow'))->with('attendanceSuccess', session('attendanceSuccess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
