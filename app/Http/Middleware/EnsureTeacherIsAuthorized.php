<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTeacherIsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Get all subject of the authenticated user, then get all sub codes and compare it with requested subject
        $validSubjectCodes = [];
        $authorizedSubjects = auth()->user()->bctSubjects;
        foreach ($authorizedSubjects as $subject) {
            array_push($validSubjectCodes, $subject->subject_code);
        }
        if (in_array($request->subject->subject_code, $validSubjectCodes)) {
            return $next($request);
        } else {
            return redirect('/teachers/home')->with('unAuthorizedSubject', 'You are not authorized to edit this subject');
        }
    }
}
