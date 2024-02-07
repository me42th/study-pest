<?php

namespace App\Http\Controllers;

use App\Models\{
    Course,
    Video
};

class PageVideosController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Course $course, Video $video)
    {
        $video = $video->exists? $video: $course->videos->first();
        return view('pages.course-videos',compact('video'));
    }
}
