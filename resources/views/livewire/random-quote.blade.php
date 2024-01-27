<?php

use \App\Services\ZenQuotesService;
use \Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{state, layout, mount};

layout('layouts.app');

state([
    'quote' => null
]);

mount(function (ZenQuotesService $service) {
    $this->quote = $service->getRandomQuote();
});

?>
<div>
    <h1 class="text-xl font-bold mb-5">Random Quote</h1>
    <x-quote :quote="$quote['q']" :author="$quote['a']"/>
</div>
