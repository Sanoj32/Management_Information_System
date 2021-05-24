<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BctAttendance;
use App\Models\BctSubject;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
