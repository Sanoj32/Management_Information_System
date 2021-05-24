<?php

namespace App\Http\Controllers;

use App\Models\BctAttendance;
use App\Models\BctStudent;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function index()
    {
        dd(Auth::guard());
    }
}
