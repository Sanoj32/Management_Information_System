<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\BctStudent;
use App\Models\BctSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;
use League\CommonMark\Extension\Table\Table;
use Symfony\Component\Console\Helper\TableRows;

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
        $authorizedSubjects = DB::table('bct_authorized_subjects')->where('teacher_code', $teacher_code)->get();
        return view('admin.teacher_profile', compact('teacher', 'authorizedSubjects'));
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
        return view('admin.edit_permission', compact('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'teacher_code', 'teacher', 'batch'));
    }
    public function changePermission($teacher_code, $batch, $subject_code)
    {
        $teacher = User::where('teacher_code', $teacher_code)->first();
        // Check if the teacher has permission for that subject
        $exists = DB::table('bct_authorized_subjects')
            ->where('subject_code', $subject_code)
            ->where('teacher_code', $teacher_code)
            ->where('batch', $batch);
        if ($exists->count() == 1) {
            $exists->delete();
        } else {
            $teacher->bctSubjects()->attach($subject_code, ['batch' => $batch]);
        }
    }
}
