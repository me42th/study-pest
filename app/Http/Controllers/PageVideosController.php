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
        if($video->exists){
            ds('aqui');
            ds($video);
        } else {
            ds('acolá');
        }
        $video = $video->exists? $video: $course->videos->first();
        return view('pages.course-videos',compact('video'));
    }
}
