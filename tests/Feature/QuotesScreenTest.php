<?php

namespace Tests\Feature\Auth;

use App\Models\User;

test('quotes screen can be rendered', function () {
    $response = $this->get('/quotes');

    $response
        ->assertOk();
});

test('quotes screen redirects auth users to secure quotes screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/quotes');

    $response->assertStatus(302);
});
