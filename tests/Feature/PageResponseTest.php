<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use App\Models\Course;

uses (RefreshDatabase::class);
it('gives back successful response for home page', function () {
    // Act & Assert
    get(route('home'))->assertOk();
});

it('gives back successful response for course details page',function(){
    // Arrange
    $course = Course::factory()->released()->create();

    // Act && Assert
    get(route('course-details',$course))
        ->assertOk();
});