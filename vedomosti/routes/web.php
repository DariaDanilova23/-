<?php

use App\Http\Controllers\ActiveCourseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ReportController::class, 'create'])->name('welcome');
Route::get('/bestStudent', [ReportController::class, 'bestStudent']);
Route::resource('professor', ProfessorController::class);
Route::resource('student', StudentController::class);
Route::resource('course', CourseController::class);
Route::resource('activecourse', ActiveCourseController::class);
