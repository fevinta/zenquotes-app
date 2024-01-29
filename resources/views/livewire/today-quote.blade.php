<?php

use App\Livewire\Actions\Favorite;
use App\Services\ZenQuotesService;
use Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'data' => fn(ZenQuotesService $service) => $service->getTodayQuote()
]);

$refreshQuote = function (ZenQuotesService $service) {
    $this->data = $service->getTodayQuote(refresh: true);
};

$favorite = function (Favorite $favorite) {
    $favorite(
        author: $this->data['quotes'][0]['a'],
        quote: $this->data['quotes'][0]['q']
    );
    $this->dispatch('notify', 'Today\'s quote added to favorites!');
};

?>

<div>
    <h1 class="text-xl font-bold mb-5">Today's Quote</h1>
    <x-quote :cached="$data['cached']" :quote="$data['quotes'][0]">
        <x-refresh-button wire:click="refreshQuote"/>
        <x-favorite-button wire:click="favorite"/>
    </x-quote>
</div>
