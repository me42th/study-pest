<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use Carbon\Carbon;
use App\Models\Course;

uses(RefreshDatabase::class);

it('shows courses overview',function(){
    // Arrange
    $courseA = Course::factory()->released()->create();
    $courseB = Course::factory()->released()->create();
    $courseC = Course::factory()->released()->create();

    // Act && Assert
    get(route('home'))
        ->assertSeeText([
            $courseA->title,
            $courseA->description,
            $courseB->title,
            $courseB->description,
            $courseC->title,
            $courseC->description
        ]);
});

it('shows only released courses',function(){
    // Arrange
    $released = Course::factory()->released()->create();
    $notReleased = Course::factory()->create();

    // Act && Assert
    get(route('home'))->assertSeeText($released->title)->assertDontSee($notReleased->title);
});

it('shows courses by release date', function(){
    // Arrange
    $releasedCourse = Course::factory()->released()->create();
    $newestReleasedCourse = Course::factory()->released(Carbon::yesterday())->create();

    // Act && Assert
    get(route('home'))
        ->assertSeeTextInOrder([
            $releasedCourse->title,
            $newestReleasedCourse->title
        ]);
});