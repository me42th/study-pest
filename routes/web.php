<?php

use App\Http\Controllers\{
    PageHomeController,
    PageCourseDetailsController,
    PageDashboardController,
    PageVideosController
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

Route::get('/', PageHomeController::class)->name('pages.home');
Route::get('course/{course:slug}',PageCourseDetailsController::class)->name('pages.course-details');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',PageDashboardController::class)->name('pages.dashboard');
    Route::get('videos/{course:slug}/{video:slug?}',PageVideosController::class)->name('pages.course-videos');
});
