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
    $title = fake()->name;
    $description = fake()->name;
    $duration = random_int(1,10);
    $course = Course::factory()
        ->has(Video::factory()->state(
            compact(['title','description','duration'])
        ))->create();

    //Act && Assert
    Livewire::test(VideoPlayer::class,['video'=>$course->videos->first()])
        ->assertSeeText([
            $title,
            $duration,
            $description
        ]);
});

it('shows given video',function(){
    //Arrange
    $course = Course::factory()
        ->has(Video::factory()->state([
            'vimeo_id' => 'vimeo-id'
        ]))->create();

    //Act && Assert
    Livewire::test(VideoPlayer::class,['video'=>$course->videos->first()])
        ->assertSee('<iframe src="https://player.vimeo.com/video/vimeo-id"',false);
});