<?php

use App\Models\{
    Course,
    Video
};
use function Pest\Laravel\get;

use Illuminate\Foundation\Testing\RefreshDatabase;
uses (RefreshDatabase::class);

it('does not find unreleased course',function(){
    // Arrange
    $course = Course::factory()->create();

    // Act && Assert
    get(route('course-details',$course))
        ->assertNotFound();
});

it('shows course details',function(){
    // Arrange
    $course = Course::factory()->released()->create();

    // Act && Assert
    get(route('course-details',$course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings
        ])->assertSee(asset("images/{$course->image_name}"));
});

it('shows course video count',function(){
    // Arrange
    $this->withoutExceptionHandling();
    $course = Course::factory()
        ->released()
        ->has(Video::factory()
        ->count(3))
        ->create();

    // Act && Assert
    get(route('course-details',$course))
        ->assertSeeText('3 videos');
});