<?php

use Livewire\Livewire;
use App\Livewire\VideoPlayer;
use function Pest\Faker\fake;
use App\Models\{
    Course,
    Video
};

it('shows details for given video',function(){
    //Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();
    $video = $course->videos->first();

    //Act && Assert
    Livewire::test(VideoPlayer::class,compact('video'))
        ->assertSeeText(
            \Arr::only($video->toArray(),['title','description','duration'])
        );
});

it('shows given video',function(){
    //Arrange
    $course = Course::factory()
        ->has(Video::factory()->vimeoId('vimeoId'))->create();

    //Act && Assert
    $video = $course->videos->first();
    Livewire::test(VideoPlayer::class,compact('video'))
        ->assertSeeHtml("<iframe src=\"https://player.vimeo.com/video/$video->vimeo_id\"");
});