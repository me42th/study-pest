<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use App\Models\Course;

uses(RefreshDatabase::class);

it('shows courses overview',function(){
    // Arrange
    $courseA = Course::factory()->create(['title' => 'Course A','description' => 'description of course a']);
    $courseB = Course::factory()->create(['title' => 'Course B','description' => 'description of course b']);
    $courseC = Course::factory()->create(['title' => 'Course C','description' => 'description of course c']);

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

    // Act

    // Assert
});

it('shows courses by release date', function(){
    // Arrange

    // Act

    // Assert
});