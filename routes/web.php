<?php

// use Illuminate\Support\Facades\App;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest', 'guest:admin']);
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
    Route::get('/teachers', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'index']);
    Route::get('/teachers/{teacher_code}', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'showProfile']);
    Route::get('/teachers/{teacher_code}/edit/{batch}', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'showEditView']);

    Route::post('/teachers/{teacher_code}/edit/{batch}/{subject_code}', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'changePermission']);
});

Auth::routes();
Route::prefix('/teachers')->name('teacher.')->middleware('auth')->group(function () {
    Route::get('/home', [AttendanceController::class, 'home'])->name('home');
    Route::get('/attendancedashboard/{batch}/{subject}', [AttendanceController::class, 'index']);
    Route::get('/attendance/{batch}/{subject}/', [AttendanceController::class, 'showAttendanceView']);
    Route::post('/attendance/{batch}/{subject}/{day}', [AttendanceController::class, 'recordAttendance'])->name('recordAttendance');
    Route::get('/attendance/{batch}/{subject}/{lastDay}/edit', [AttendanceController::class, 'showUpdateView']);
    Route::patch('/attendance/{batch}/{subject}/{lastDay}', [AttendanceController::class, 'updateAttendance']);



    // only subject instead of subject_code in above route because type hinting BctSubject inside the controller method takes care of dependency Injection

});
// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/test', [App\Http\Controllers\WebsiteController::class, 'index']);
// Route::get('/vue', [\App\Http\Controllers\WebsiteController::class, 'vue']);
// Route::post('/test', [App\Http\Controllers\WebsiteController::class, 'takeAttendance'])->name('attendance');
// // Route::get('/attendance/bct/{batch}/{subject_code}',[])
// Route::get('/home', [App\Http\Controllers\AttendanceController::class, 'index'])->name('home');  // this is where the teachers land after loggin in.
