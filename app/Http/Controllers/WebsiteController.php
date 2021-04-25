<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function takeAttendance(Request $request)
    {
        dd($request);
    }
}
