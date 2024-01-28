<?php

use App\Livewire\Actions\Favorite;
use App\Services\ZenQuotesService;
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'quote' => fn(ZenQuotesService $service) => $service->getRandomQuotes()[0]
]);

$refreshQuote = function (ZenQuotesService $service) {
    $quotes = $service->getRandomQuotes(forceNew: true);
    if (empty($quotes)) {
        $this->quote = [
            'q' => 'You reach the limit of request, please wait and try again.',
            'a' => 'Too many requests'
        ];
    } else {
        $this->quote = $quotes[0];
    }
};

$favorite = function (Favorite $favorite) {
    $favorite(
        author: $this->quote['a'],
        quote: $this->quote['q']
    );
    $this->dispatch('notify', 'Favorite added!');
};

?>
<div>
    <h1 class="text-xl font-bold mb-5">Random Quote</h1>
    <x-quote :quote="$quote['q']" :author="$quote['a']">
        <x-refresh-button wire:click="refreshQuote"/>
        <x-favorite-button wire:click="favorite"/>
    </x-quote>
</div>
