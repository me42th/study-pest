<?php


use function Pest\Laravel\get;
use App\Models\{
    Course,
    User
};


it('gives back successful response for home page', function () {
    // Act & Assert
    get(route('pages.home'))->assertOk();
});

it('gives back successful response for course details page',function(){
    // Arrange
    $course = Course::factory()->released()->create();

    // Act && Assert
    get(route('pages.course-details',$course))
        ->assertOk();
});

it('gives back successful response for dashboard page',function(){
    // Arrange && Act && Assert
    loginAsUser();
    get(route('pages.dashboard'))
        ->assertOk();
});