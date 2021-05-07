<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendancePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
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
        $teacher = User::where('teacher_code', $teacher_code)->get()->first();
        $authorizedSubjects = $teacher->bctSubjects;
        return view('teacher.profile', compact('teacher', 'authorizedSubjects'));
    }
    public function showEditView($teacher_code, $batch)
    {
        $subjects = BctSubject::all();
        $first = $subjects->where('semester', 1);
        $second = $subjects->where('semester', 2);
        $third = $subjects->where('semester', 3);
        $fourth = $subjects->where('semester', 4);
        $fifth = $subjects->where('semester', 5);
        $sixth = $subjects->where('semester', 6);
        $seventh = $subjects->where('semester', 7);
        $eighth = $subjects->where('semester', 8);
        $teacher = User::where('teacher_code', $teacher_code)->first();
        return view('admin.editPermission', compact('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'teacher_code', 'teacher', 'batch'));
    }
    public function changePermission($teacher_code, $batch, $subject_code)
    {
        $teacher = User::where('teacher_code', $teacher_code)->first();
        if ($teacher->bctSubjects->contains($subject_code)) {
            $teacher->bctSubjects()->detach($subject_code, ['batch' => $batch]);
        } else {
            $teacher->bctSubjects()->attach($subject_code, ['batch' => $batch]);
        }
    }
}
