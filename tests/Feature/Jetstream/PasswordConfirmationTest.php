<?php

use App\Models\User;
use Laravel\Jetstream\Features;

test('confirm password screen can be rendered', function () {
    $user = Features::hasTeamFeatures()
                    ? User::factory()->withPersonalTeam()->create()
                    : User::factory()->create();
    loginAsUser($user);

    $response = $this->get('/user/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    loginAsUser();

    $response = $this->post('/user/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    loginAsUser();

    $response = $this->post('/user/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
