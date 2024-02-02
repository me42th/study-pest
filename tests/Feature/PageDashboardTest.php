<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\{
    User,
    Course
};
use function Pest\Laravel\{
    get,
    actingAs
};

uses(RefreshDatabase::class);

it('cannot be accessed by guest', function () {
    // Act && Assert
    get(route('dashboard'))
        ->assertRedirect(route('login'));
});

it('list purchased courses', function () {
    // Arrange
    $user = User::factory()
        ->has(
            Course::factory()
                ->count(2)
                ->state(
                    new Sequence(
                        ['title' => 'Course A'],
                        ['title' => 'Course B']
                    )
                )
            )
        ->create();

    // Act && Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B'
        ]);
});

it('does not list other courses', function () {
    // Arrange
    $user = User::factory()->create();
    $course = Course::factory()->create();

    // Act && Assert
    actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertDontSeeText($course->title);
});

it('shows latest purchased course first', function () {
    // Arrange
    $user = User::factory()->create();
    $firstPurchasedCourse = Course::factory()->create();
    $lastPurchasedCourse = Course::factory()->create();

    $user->courses()->attach($firstPurchasedCourse,['created_at' => Carbon::yesterday()]);
    $user->courses()->attach($lastPurchasedCourse,['created_at' => Carbon::now()]);

    // Act && Assert
    actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeInOrder([
            $lastPurchasedCourse->title,
            $firstPurchasedCourse->title
        ]);
});

it('includes link to product videos',function(){
    // Arrange
    $user = User::factory()
        ->has(Course::factory())
        ->create();

    //Act && Assert
    $this->actingAs($user);
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Watch videos')
        ->assertSee(route('page.course-videos',Course::first()));
});