<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => "Test mail",
            'body' => "Nice"
        ];
        Mail::to('sanoj.shrestha.13@gmail.com')->send(new TestMail($details));
        return "Mail sent successfully";
    }
}
