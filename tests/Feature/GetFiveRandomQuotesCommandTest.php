<?php

use Illuminate\Support\Facades\Cache;

it('returns five quotes', function () {
    Cache::flush();

    $this->artisan('Get-FiveRandomQuotes')
        ->doesntExpectOutputToContain('[Cached]')
        ->assertExitCode(0);
});

it('returns five quotes without cache and with cache on the second attempt', function () {
    Cache::flush();

    $this->artisan('Get-FiveRandomQuotes')
        ->doesntExpectOutputToContain('[Cached]')
        ->assertExitCode(0);

    $this->artisan('Get-FiveRandomQuotes')
        ->expectsOutputToContain('[Cached]')
        ->assertExitCode(0);
});
