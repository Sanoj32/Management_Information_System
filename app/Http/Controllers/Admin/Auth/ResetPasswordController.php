<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
}
