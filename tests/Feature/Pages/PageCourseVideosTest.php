<?php

use function Pest\Laravel\get;
use function Pest\Faker\fake;
use App\Models\{
    Course,
    Video
};
use App\Livewire\VideoPlayer;

use Illuminate\Database\Eloquent\Factories\Sequence;

it('cannot be accessed by guest',function(){
    // Arrange
    $course = Course::factory()->create();

    // Act && Assert
    get(route('pages.course-videos',$course))
        ->assertRedirect(route('login'));
});

it('include video player', function(){
    // Arrange
    $course = Course::factory()
        ->has(Video::factory())
        ->create();

    // Act && Assert
    loginAsUser();
    get(route('pages.course-videos',$course))
        ->assertSeeLivewire(VideoPlayer::class);
});

it('shows first course video by default', function(){
    // Arrange
    $course = Course::factory()
        ->has(Video::factory()->state(['title' => 'cool','description'=>fake()->name,'duration'=>random_int(2,10)]))
        ->create();

    // Act && Assert
    loginAsUser();
    get(route('pages.course-videos',$course))
        ->assertOk()
        ->assertSeeText('cool');
});

it('shows provided course video',function (){
    // Arrange
    $titles = [
        ['title' => fake()->name,'description'=>fake()->name,'duration'=>random_int(2,10)],
        ['title' => fake()->name,'description'=>fake()->name,'duration'=>random_int(2,10)]
    ];
    $course = Course::factory()
        ->has(Video::factory()
        ->state(new Sequence(
            ...$titles
        ))->count(2)
        )
        ->create();

    // Act && Assert
    loginAsUser();
    get(route('pages.course-videos',[
        'course' => $course,
        'video' => $course->videos()->orderByDesc('id')->first()
    ]))
        ->assertOk()
        ->assertSeeText($titles[1]['title']);
});