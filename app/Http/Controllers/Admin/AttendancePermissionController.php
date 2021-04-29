<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendancePermissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    /**
     * This function retuns a view containing a list of all the teachers
     *
     */


    public function index()
    {
        $teachers = User::all();
        return view('admin.teachers', compact('teachers'));
    }
    public function showProfile($teacher_code)
    {
        // dd($teacher_code);

        $teacher = DB::table('users')->where('teacher_code', $teacher_code)->get()->first();
        return view('teacher.profile', compact('teacher'));
    }
}
