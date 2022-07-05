<?php
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
Route::get('/show', [ReportController::class, 'create'])->name('report');
