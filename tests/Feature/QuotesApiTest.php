
<?php

use Illuminate\Support\Facades\Cache;

it('returns a successful response without cache and afterwards with cache', function () {
    Cache::flush();

    $response = $this->get('/api/quotes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);

    $this->assertTrue(!str_starts_with($response->json()[0]['text'], '[Cached]'));

    $response = $this->get('/api/quotes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);

    $this->assertTrue(str_starts_with($response->json()[0]['text'], '[Cached]'));
});

it('returns a successful response without cache', function () {
    $response = $this->get('/api/quotes/new');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'text',
                'author'
            ]
        ]);

    $this->assertTrue(!str_starts_with($response->json()[0]['text'], '[Cached]'));
});

