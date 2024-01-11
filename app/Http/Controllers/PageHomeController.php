<?php

namespace App\Http\Controllers;
use App\Models\Course;

class PageHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $courses = Course::released()->get();
        return view('home',compact('courses'));
    }
}
