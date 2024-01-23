<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\{
    User,
    Course
};
use function Pest\Laravel\get;

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

    // Act && Assert
});

it('shows latest purchased course first', function () {
    // Arrange

    // Act && Assert
});

it('includes link to product videos',function(){
    // Arrange

    //Act && Assert
});