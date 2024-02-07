<?php
use App\Models\Video;

it('gives back readable video duration',function(){
    // Arrange
    $video = Video::factory()->create();

    // Act && Assert
    expect($video->getReadableDuration())->toEqual("{$video->duration_in_minutes}min");
});