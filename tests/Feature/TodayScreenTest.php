<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Volt\Volt;

test('today screen can be rendered', function () {
    $response = $this->get('/today');

    $response
        ->assertOk()
        ->assertSeeVolt('today-quote')
        ->assertSeeVolt('random-quote')
        ->assertSeeVolt('random-image');
});

test('can see today\'s quote', function () {
    $component = Volt::test('today-quote')
        ->assertSee('Quote of the Day');
});
