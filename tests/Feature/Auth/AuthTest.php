<?php

use App\Models\User;

test('it should login', function () {
    $user = User::factory()->create();

    $this->postJson('api/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertStatus(200)
        ->assertJsonStructure([
            'token',
        ]);
});

test('it should get authenticated user data', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('api/auth/me')
        ->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
});

it('should logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson('api/auth/logout')
        ->assertStatus(200);
});