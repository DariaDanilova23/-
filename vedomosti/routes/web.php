<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ReportController;
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

//Route::get('/', [ActiveCourseController::class, 'index'])->name('welcome');
//Route::get('/contents-arr', [ActiveCourseController::class,'createContents']);
//Route::get('/try', [ReportController::class,'index']);
Route::get('/', [ReportController::class, 'index'])->name('welcome');
Route::get('/professor', [ReportController::class, 'professor'])->name('professor');
Route::get('/show', [ReportController::class, 'create'])->name('report');
Route::post('remove-professor', [FormController::class, 'remove'])->name('remove.recordProfessor');
Route::get('remove-professor', [FormController::class, 'remove'])->name('remove.recordProfessor');
Route::post('update-professor', [FormController::class, 'update'])->name('update.recordProfessor');
Route::get('update-professor', [FormController::class, 'update'])->name('update.recordProfessor');
Route::post('professor/add-professor', [FormController::class, 'create'])->name('add.recordProfessor');
