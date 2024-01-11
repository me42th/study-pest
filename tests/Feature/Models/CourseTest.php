<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('released scope', function () {
    // Arrange
    Course::factory()->released()->create();
    Course::factory()->create();

    // Act && Assert
    expect(Course::released()->get())
        ->toHaveCount(1)
        ->first()->id->toEqual(1);
});
