<?php

namespace App\Http\Controllers;
use App\Models\Course;

class PageCourseDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Course $course)
    {
        \Log::info(print_r($course,true));
        return view('course-details',compact('course'));
    }
}
