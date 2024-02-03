<?php

use App\Models\Course;
use Carbon\Carbon;


use function Pest\Laravel\get;



it('shows courses overview', function () {
    // Arrange
    $courseA = Course::factory()->released()->create();
    $courseB = Course::factory()->released()->create();
    $courseC = Course::factory()->released()->create();

    // Act && Assert
    get(route('pages.home'))
        ->assertSeeText([
            $courseA->title,
            $courseA->description,
            $courseB->title,
            $courseB->description,
            $courseC->title,
            $courseC->description,
        ]);
});

it('shows only released courses', function () {
    // Arrange
    $released = Course::factory()->released()->create();
    $notReleased = Course::factory()->create();

    // Act && Assert
    get(route('pages.home'))->assertSeeText($released->title)->assertDontSee($notReleased->title);
});

it('shows courses by release date', function () {
    // Arrange
    $releasedCourse = Course::factory()->released()->create();
    $newestReleasedCourse = Course::factory()->released(Carbon::yesterday())->create();

    // Act && Assert
    get(route('pages.home'))
        ->assertSeeTextInOrder([
            $releasedCourse->title,
            $newestReleasedCourse->title,
        ]);
});

it('includes login if not logged in',function(){
    // Arrange

    // Act &&  Assert
    get(route('pages.home'))
        ->assertOK()
        ->assertSeeText('Login')
        ->assertSee(route('login'));
});

it('includes logged out if logged in',function(){
    // Arrange
    loginAsUser();

    // Act && Assert
    get(route('pages.home'))
        ->assertOK()
        ->assertSee('Log out')
        ->assertSee(route('logout'));
});