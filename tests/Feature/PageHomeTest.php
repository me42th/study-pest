<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use Carbon\Carbon;
use App\Models\Course;

uses(RefreshDatabase::class);

it('shows courses overview',function(){
    // Arrange
    $courseA = Course::factory()->create(['title' => 'Course A','description' => 'description of course a', 'released_at' => Carbon::yesterday()]);
    $courseB = Course::factory()->create(['title' => 'Course B','description' => 'description of course b', 'released_at' => Carbon::yesterday()]);
    $courseC = Course::factory()->create(['title' => 'Course C','description' => 'description of course c', 'released_at' => Carbon::yesterday()]);

    // Act && Assert
    get(route('home'))
        ->assertSeeText([
            'Course A',
            'Course B',
            'Course C',
            'description of course a',
            'description of course b',
            'description of course c'
        ]);
});

it('shows only released courses',function(){
    // Arrange
    $released = Course::factory()->create(['title' => 'Course A', 'released_at' => Carbon::yesterday()]);
    $notReleased = Course::factory()->create(['title' => 'Course B']);

    // Act && Assert
    get(route('home'))->assertSeeText('Course A')->assertDontSee('Course B');
});

it('shows courses by release date', function(){
    // Arrange
    $firstCourse = Course::factory()->create(['title' => 'Course A','released_at' => Carbon::now()]);
    $secondCourse = Course::factory()->create(['title' => 'Course B','released_at' => Carbon::yesterday()]);

    // Act && Assert
    get(route('home'))
        ->assertSeeTextInOrder([
            'Course A',
            'Course B'
        ]);
});