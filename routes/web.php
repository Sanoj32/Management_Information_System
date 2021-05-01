<?php

// use Illuminate\Support\Facades\App;
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
    Route::get('/teachers', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'index']);
    Route::get('/teachers/{teacher_code}', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'showProfile']);
    Route::get('/teachers/{teacher_code}/edit', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'showEditView']);
    Route::post('/teachers/{teacher_code}/edit/{subject_code}', [\App\Http\Controllers\Admin\AttendancePermissionController::class, 'changePermission']);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\WebsiteController::class, 'test']);
Route::post('/test', [App\Http\Controllers\WebsiteController::class, 'takeAttendance'])->name('attendance');
// Route::get('/attendance/bct/{batch}/{subject_code}',[])
Route::get('/home', [App\Http\Controllers\AttendanceController::class, 'index'])->name('home');  // this is where the teachers land after loggin in.
