<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;

it('returns a unauthenticated response', function () {
    $response = $this->withHeaders([
        'Accept' => 'application/json',
    ])->get('/api/secure-quotes');

    $response->assertStatus(401);
});

it('returns a successful response', function () {
    $user = User::factory()->create();

    $token = $user->createToken('test-token')->plainTextToken;

    $response = $this->withHeaders([
        'Accept'        => 'application/json',
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/secure-quotes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);
});

it('returns a successful response without cache and afterwards with cache', function () {
    $user = User::factory()->create();

    $token = $user->createToken('test-token')->plainTextToken;

    Cache::flush();

    $response = $this->withHeaders([
        'Accept'        => 'application/json',
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/secure-quotes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);

    $this->assertTrue(!str_starts_with($response->json()[0]['text'], '[Cached]'));

    $response = $this->withHeaders([
        'Accept'        => 'application/json',
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/secure-quotes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);

    $this->assertTrue(str_starts_with($response->json()[0]['text'], '[Cached]'));
});

