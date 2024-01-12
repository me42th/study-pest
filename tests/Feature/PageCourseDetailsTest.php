<?php

use App\Models\{
    Course,
    Video
};
use function Pest\Laravel\get;

use Illuminate\Foundation\Testing\RefreshDatabase;
uses (RefreshDatabase::class);

it('shows course details',function(){
    // Arrange
    $course = Course::factory()->create();

    // Act && Assert
    get(route('course-details',$course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            $course->image,
            ...$course->learnings
        ]);
});

it('shows course video count',function(){
    // Arrange
    $this->withoutExceptionHandling();
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    // Act && Assert
    get(route('course-details',$course))
        ->assertSeeText('3 videos');
});