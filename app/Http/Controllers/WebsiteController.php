<?php

namespace App\Http\Controllers;

use App\Models\BctAttendance;
use App\Models\BctStudent;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('test');
    }
    public function test()
    {
        DB::table('bct_authorized_subjects')->insert([
            'teacher_code' => '56130',
            'subject_code' => 'M5UsfP'
        ]);
    }
    public function vue()
    {
        return view('vue');
    }

    public function takeAttendance(Request $request)
    {
        $students = BctStudent::all();
        foreach ($students as $student) {
            $present = 0;
            if (in_array($student->roll_number, $request->attendance)) {
                $present = 'present';
            }
            BctAttendance::create([
                'subject_code' => 'wqcpPT',
                'day' => 1,
                'batch' => 77,
                'teacher_code' => '17199',
                'attendance' => $present,
                'roll_number' => $student->roll_number,
            ]);
        }
    }
}
