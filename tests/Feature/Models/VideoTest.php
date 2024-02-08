<?php
use App\Models\{
    Video,
    Course
};

it('belongs to a course', function () {
    // Arrange
    $video = Video::factory()
        ->has(Course::factory())
        ->create();

    // Act && Assert
    expect($video->course)
        ->toBeInstanceOf(Course::class);
});

it('gives back readable video duration',function(){
    // Arrange
    $video = Video::factory()->create();

    // Act && Assert
    expect($video->getReadableDuration())->toEqual("{$video->duration_in_minutes}min");
});