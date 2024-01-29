<?php

use App\Livewire\Actions\Favorite;
use App\Services\ZenQuotesService;
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'data' => fn(ZenQuotesService $service) => $service->requestQuotes()
]);

$refreshQuote = function (ZenQuotesService $service) {
    $this->data = $service->requestQuotes(refresh: true);
};

$favorite = function (Favorite $favorite) {
    $favorite(
        author: $this->data['quotes'][0]['a'],
        quote: $this->data['quotes'][0]['q']
    );
    $this->dispatch('notify', 'Favorite added!');
};

?>
<div>
    <h1 class="text-xl font-bold mb-5">Random Quote</h1>
    <x-quote :cached="$data['cached']" :quote="$data['quotes'][0]">
        <x-refresh-button wire:click="refreshQuote"/>
        <x-favorite-button wire:click="favorite"/>
    </x-quote>
</div>
