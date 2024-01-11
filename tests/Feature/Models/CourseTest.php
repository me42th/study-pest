<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Course;

uses(RefreshDatabase::class);

test('released scope',function (){
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act && Assert
    expect(Course::released()->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});
