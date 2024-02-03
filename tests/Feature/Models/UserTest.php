<?php

use App\Models\{
    User,
    Course
};


test('has courses', function () {
    // Arrange
    $user = User::factory()
        ->has(Course::factory()->count(2))
        ->create();

    // Act && Assert
    expect($user->courses)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Course::class);
});