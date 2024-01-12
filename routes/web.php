<?php

use App\Http\Controllers\{
    PageHomeController,
    PageCourseDetailsController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', PageHomeController::class)->name('home');
Route::get('course/{course:slug}',PageCourseDetailsController::class)->name('course-details');