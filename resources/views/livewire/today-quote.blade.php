<?php

use App\Livewire\Actions\Favorite;
use App\Services\ZenQuotesService;
use Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{layout, state};

layout('layouts.app');

state([
    'quote' => fn(ZenQuotesService $service) => $service->getTodayQuote()
]);

$clearCache = function (ZenQuotesService $service) {
    Cache::forget('today-quote');
    $this->quote = $service->getTodayQuote();
};

$refreshQuote = function (ZenQuotesService $service) {
    $this->quote = $service->getTodayQuote(refresh: true);
};

$favorite = function (Favorite $favorite) {
    $favorite(
        author: $this->quote['data']['a'],
        quote: $this->quote['data']['q']
    );
    $this->dispatch('notify', 'Today\'s quote added to favorites!');
};

?>

<div>
    <h1 class="text-xl font-bold mb-5">Today's Quote</h1>
    <x-quote :quote="$quote['data']['q']" :author="$quote['data']['a']">
        @if($quote['cached'])
            <x-cache-button wire:click="clearCache"/>
        @endif
        <x-refresh-button wire:click="refreshQuote"/>
        <x-favorite-button wire:click="favorite"/>
    </x-quote>
</div>
