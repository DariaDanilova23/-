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

Route::get('/', [ReportController::class, 'index'])->name('welcome');
Route::get('/show', [ReportController::class, 'create'])->name('report');
Route::resource('professor', ProfessorController::class);
Route::post('update-professor', [ProfessorController::class, 'update']);
Route::get('update-professor', [ProfessorController::class, 'update']);
Route::resource('student', StudentController::class);
Route::post('update-student', [StudentController::class, 'update']);
Route::get('update-student', [StudentController::class, 'update']);
Route::resource('course', CourseController::class);
Route::post('update-course', [CourseController::class, 'update']);
Route::get('update-course', [CourseController::class, 'update']);
Route::resource('activecourse', ActiveCourseController::class);
Route::post('update-activecourse', [ActiveCourseController::class, 'update']);
Route::get('update-activecourse', [ActiveCourseController::class, 'update']);

