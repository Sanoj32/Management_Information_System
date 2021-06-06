<?php

// use Illuminate\Support\Facades\App;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\StudentAnalysisController;
use App\Http\Controllers\Admin\AttendancePermissionController;
use App\Http\Controllers\Admin\BctAttendanceReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/mail', [MailController::class, 'sendMail']);

Route::get('/', function () {
    return view('welcome');
})->middleware('desiredredirect');
Route::get('/updates', function () {
    return view('updates');
});
Route::prefix('/admin')->name('admin.')->group(function () {

    //Login Routes
    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    //Forgot Password Routes
    Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'reset'])->name('password.update');
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home')->middleware('auth:admin');

    //Grant various permissions
    Route::get('/teachers', [AttendancePermissionController::class, 'index']);
    Route::get('/teachers/{teacher_code}', [AttendancePermissionController::class, 'showProfile']);
    Route::get('/teachers/{teacher_code}/edit/{batch}', [AttendancePermissionController::class, 'showEditView']);

    Route::post('/teachers/{teacher_code}/edit/{batch}/{subject_code}', [AttendancePermissionController::class, 'changePermission']);
    // Route::get('/students/{roll}',[])

    // Bct Attendance Report Controller
    Route::get('/attendance', [BctAttendanceReportController::class, 'index']);
    Route::get('/attendance/{batch}/{subject}', [BctAttendanceReportController::class, 'show']);
    Route::post('/attendance/close/{batch}/{subject}', [BctAttendanceReportController::class, 'create']);
    Route::get('/closed/attendance', [BctAttendanceReportController::class, 'closedAttendanceIndex']);
    Route::get('/closed/attendancedashboard/{batch}/{subject}', [BctAttendanceReportController::class, 'showClosedAttendanceDashboard']);
    Route::get('/closed/attendance/{batch}', [BctAttendanceReportController::class, 'showClosedAttendanceView']);

    // Student attendance analysis routes
    Route::get('/analysis/student', [StudentAnalysisController::class, 'index']); // Returns select student view
    Route::post('/analysis/student', [StudentAnalysisController::class, 'show']);  // Returns the attendance analysis of a single student.
});


Auth::routes();
Route::prefix('/teachers')->name('teacher.')->middleware('auth')->group(function () {
    Route::get('/home', [AttendanceController::class, 'home'])->name('home');
    Route::middleware('authorized:batch,subject')->group(function () {
        Route::get('/attendancedashboard/{batch}/{subject}', [AttendanceController::class, 'index']);
        Route::get('/attendance/{batch}/{subject}/{day}', [AttendanceController::class, 'showAttendanceView']);
        Route::post('/attendance/{batch}/{subject}/{day}', [AttendanceController::class, 'recordAttendance'])->name('recordAttendance');
        Route::get('/attendance/{batch}/{subject}/{lastDay}/edit', [AttendanceController::class, 'showUpdateView']);
        Route::patch('/attendance/{batch}/{subject}/{lastDay}', [AttendanceController::class, 'updateAttendance']);
        Route::get('/closed/attendancedashboard/{batch}/{subject}', [AttendanceController::class, 'showClosedAttendanceView']);
    });



    // only subject instead of subject_code in above route because type hinting BctSubject inside the controller method takes care of dependency Injection

});
Route::get('/suspended', function () {
    return view('suspended');
})->middleware("unsusredirect"); // unsusredirect => redirect if the user isn't suspeneded
// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\WebsiteController::class, 'index']);
// Route::get('/vue', [\App\Http\Controllers\WebsiteController::class, 'vue']);
// Route::post('/test', [App\Http\Controllers\WebsiteController::class, 'takeAttendance'])->name('attendance');
// // Route::get('/attendance/bct/{batch}/{subject_code}',[])
// Route::get('/home', [App\Http\Controllers\AttendanceController::class, 'index'])->name('home');  // this is where the teachers land after loggin in.
