<?php

namespace Tests\Feature\Auth;

use App\Models\User;

test('secure quotes screen can\'t be rendered by unauthenticated users', function () {
    $response = $this->get('/secure-quotes');

    $response->assertStatus(302);
});

test('secure quotes screen can be rendered by authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/secure-quotes');

    $response->assertOk();
});
